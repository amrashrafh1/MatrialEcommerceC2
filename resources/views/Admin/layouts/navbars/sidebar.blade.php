@php
$products_seller_count = App\Product::where('approved', 0)->whereHas('store')->count();
$products_count        = App\Product::where('approved', 0)->count();
$orders_count          = App\Order::where('status','pending')->count();
$stores_count          = App\SellerInfo::where('approved', 0)->count();
$cms_array = [
'teams-management', 'contact_us-management'
,'testimonials-management','services-management','ourworks-management','sliders-management'
];
$shipping_page = ['methods-management',
'shippingcompanies-management',
'zones-management'];
$discount_page = ['coupons-management',
'discount-management'];
$activities = ['Logs',
'activities-management'];
$marketplace = [
'seller-products-management',
'seller-management'];
@endphp
<div class="sidebar" data-color="{{(\Cookie::get('color') != NULL)?\Cookie::get('color'):'orange'}}"
    data-background-color="white"
    data-image="{{(\Cookie::get('image') != NULL)?\Cookie::get('image'): asset('material') . '/img/sidebar-1.jpg'}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
    -->
    <div class="logo">
        <a href="{{route('home')}}" class="simple-text logo-normal">
            {{$setting?$setting->sitename:'Laravel'}}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <p>{{ trans('admin.dashboard') }}</p>
                </a>
            </li>
            <li class="nav-item{{ in_array($activePage, $marketplace) ? ' collapsed' : '' }} pr-0 list-group">
                <a href="#sub-menu" class="list-group-item" data-toggle="collapse" data-parent="#main-menu"><i
                        class="material-icons">
                        shopping_basket
                    </i>
                    <p class='notification'>{{ trans('admin.marketplace') }}
                        <span class='badge'>{{$stores_count + $products_seller_count}}</span>
                        <span class="caret mr-2"></span>
                    </p>
                </a>
            </li>
            <li class="collapse list-group-level1 {{ in_array($activePage, $marketplace) ? ' show' : '' }}"
                id="sub-menu">
                <a href="{{ route('seller.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'seller-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu">
                    <p class='notification'>{{ trans('admin.sellers') }}
                        <span class='badge'>{{$stores_count}}
                        </span>
                    </p>
                </a>
                <a href="{{ route('seller_products') }}"
                    class="list-group-item nav-link{{ $activePage == 'seller-products-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu">
                    <p class='notification'>{{ trans('admin.sellers_products') }}
                        <span class='badge'>{{$products_seller_count}}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="material-icons">
                        perm_identity
                    </i>
                    <p class='notification'>{{ trans('admin.users') }}
                        <span class='badge'>{{$stores_count}}
                        </span>
                    </p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'category-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fas fa-building"></i>
                    <p>{{ trans('admin.categories') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'tradmark-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('tradmarks.index') }}">
                    <i class="material-icons">
                        assignment
                    </i>
                    <p>{{ trans('admin.tradmarks') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'product-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="material-icons">
                        shopping_cart
                    </i>
                    <p class='notification'>{{ trans('admin.products') }}
                        <span class='badge'>{{$products_count}}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'attribute_family-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('attribute_families.index') }}">
                    <i class='fa fa-list-ol'></i>
                    <p>{{ trans('admin.attribute_families') }}</p>
                </a>
            </li>
            <li class="nav-item{{ in_array($activePage, $shipping_page) ? '' : 'collapsed' }} pr-0 list-group">
                <a href="#sub-menu4" class="list-group-item" data-toggle="collapse" data-parent="#main-menu">
                    <i class="material-icons">
                        local_shipping
                    </i>
                    <p>
                        @lang('admin.shipping')
                        <span class="caret"></span>
                    </p>
                </a>
            </li>
            <li class="collapse list-group-level1 {{ in_array($activePage, $shipping_page) ? ' show' : '' }}"
                id="sub-menu4">
                <a href="{{ route('methods.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'methods-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu4">
                    <p class='notification'>{{ trans('admin.method') }}
                    </p>
                </a>
                <a href="{{ route('shippingcompanies.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'shippingcompanies-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu4">
                    <p class='notification'>{{ trans('admin.shippingcompanies') }}
                    </p>
                </a>
                <a href="{{ route('zones.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'zones-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu4">
                    <p class='notification'>{{ trans('admin.zones') }}
                    </p>
                </a>
            </li>
            <li class="nav-item{{ in_array($activePage, $discount_page) ? ' collapsed' : '' }} pr-0 list-group">
                <a href="#sub-menu3" class="list-group-item" data-toggle="collapse" data-parent="#main-menu">
                    <i class="material-icons">
                        local_offer
                    </i>
                    <p>
                        @lang('admin.discounts')<span class="caret"></span>
                    </p>
                </a>
            </li>
            <li class="collapse list-group-level1 {{ in_array($activePage, $discount_page) ? ' show' : '' }}"
                id="sub-menu3">
                <a href="{{ route('discounts.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'discount-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu3">@lang('admin.discounts')</a>
                <a href="{{ route('coupons.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'coupons-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu3">@lang('admin.coupons')</a>
            </li>
            <li class="nav-item{{ $activePage == 'orders' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="material-icons">
                        library_books
                    </i>
                    <p class='notification'>{{ trans('admin.orders') }}
                        <span class='badge'>{{$orders_count}}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'adzs-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ aurl('/adzs') }}">
                    <i class="fas fa-ad"></i>
                    <p>{{ trans('admin.advertizments') }}</p>
                </a>
            </li>
            <li class="nav-item{{ in_array($activePage, $activities) ? ' collapsed' : '' }} pr-0 list-group">
                <a href="#sub-menu2" class="list-group-item" data-toggle="collapse" data-parent="#main-menu">
                    <i class="fas fa-tasks"></i>
                    @lang('admin.logs')<span class="caret"></span></a>
            </li>
            <li class="collapse list-group-level1 {{ in_array($activePage, $activities) ? ' show' : '' }}"
                id="sub-menu2">
                <a href="{{ aurl('/log-viewer') }}"
                    class="list-group-item nav-link{{ $activePage == 'Logs' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu2">@lang('admin.logs')</a>
                <a href="{{ aurl('/activities') }}"
                    class="list-group-item nav-link{{ $activePage == 'activities-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu2">@lang('admin.activities')</a>
            </li>

            <li class="nav-item{{ in_array($activePage, $cms_array) ? ' collapsed' : '' }} pr-0 list-group">
                <a href="#sub-menu1" class="list-group-item" data-toggle="collapse" data-parent="#main-menu">
                    <i class="fas fa-tasks"></i>
                    @lang('admin.cms')<span class="caret"></span></a>
            </li>
            <li class="collapse list-group-level1 {{ in_array($activePage, $cms_array) ? ' show' : '' }}"
                id="sub-menu1">
                <a href="{{ route('teams.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'teams-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu1">@lang('admin.teams')</a>
                <a href="{{ route('contact_us.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'contact_us-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu1">@lang('admin.contact_us')</a>
                <a href="{{ route('testimonials.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'testimonials-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu1">@lang('admin.testimonials')</a>
                <a href="{{ route('services.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'services-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu1">@lang('admin.services')</a>
                <a href="{{ route('ourworks.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'ourworks-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu1">@lang('admin.ourworks')</a>
                <a href="{{ route('sliders.index') }}"
                    class="list-group-item nav-link{{ $activePage == 'sliders-management' ? ' active' : 'collapsed' }}"
                    data-parent="#sub-menu1">@lang('admin.sliders')</a>
            </li>
            <li class="nav-item{{ $activePage == 'manufacturers-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('manufacturers.index') }}">
                    <i class="material-icons">
                        local_taxi
                    </i>
                    <p>{{ trans('admin.manufacturers') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'mall-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('malls.index') }}">
                    <i class="material-icons">
                        local_mall
                    </i>
                    <p>{{ trans('admin.malls') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'posts-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('posts.index') }}">
                    <i class="material-icons">
                        rate_review
                    </i>
                    <p>{{ trans('admin.posts') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'country-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('countries.index') }}">
                    <i class="material-icons">
                        emoji_flags
                    </i>
                    <p>{{ trans('admin.countries') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'city-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('cities.index') }}">
                    <i class="material-icons">
                        account_balance
                    </i>
                    <p>{{ trans('admin.cities') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'Currencies' ? ' active' : '' }}">
                <a class="nav-link" href="{{ aurl('/currencies') }}">
                    <i class="material-icons">
                        attach_money
                    </i>
                    <p>{{ trans('admin.currencies') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'settings-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('settings') }}">
                    <i class="material-icons">
                        build
                    </i>
                    <p>{{ trans('admin.Settings') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'Events' ? ' active' : '' }}">
                <a class="nav-link" href="{{ aurl('/fullcalendar') }}">
                    <i class="material-icons">
                        calendar_today
                    </i>
                    <p>{{ trans('admin.calendar') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'settings-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{url('languages')}}">
                    <i class="material-icons">
                        language
                    </i>
                    <p>{{ trans('admin.languages') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
@if($direction == 'right')
<style>
    .caret {
        right: auto !important;
        left : 0 !important;
    }
</style>
@endif
