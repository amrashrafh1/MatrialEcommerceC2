<div class="sidebar" data-color="{{(\Cookie::get('color') != NULL)?\Cookie::get('color'):'orange'}}" data-background-color="white"
    data-image="{{(\Cookie::get('image') != NULL)?\Cookie::get('image'): asset('material') . '/img/sidebar-1.jpg'}}">
    <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
    <div class="logo">
        <a href="https://creative-tim.com/" class="simple-text logo-normal">
            {{ __('Creative Tim') }}
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
            <li class="nav-item{{ $activePage == 'marketplace-management' ? '' : 'collapsed' }} list-group" >
                <a href="#sub-menu" class="list-group-item" data-toggle="collapse" data-parent="#main-menu"><i class="material-icons">
                        shopping_basket
                    </i>
                    @lang('admin.marketplace')<span class="caret"></span></a>
            </li>
            <li class="collapse list-group-level1 {{ $activePage == 'seller-management' ? ' show' : '' }}" id="sub-menu">
                <a href="{{ route('seller.index') }}" class="list-group-item nav-link{{ $activePage == 'seller-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu">@lang('admin.sellers')</a>
                <a href="{{ route('seller_products') }}" class="list-group-item nav-link{{ $activePage == 'seller-products-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu">@lang('admin.products')</a>
            </li>
            <li class="nav-item{{ $activePage == 'cms-management' ? '' : 'collapsed' }} list-group" >
                <a href="#sub-menu1" class="list-group-item" data-toggle="collapse" data-parent="#main-menu"><i class="material-icons">
                        shopping_basket
                    </i>
                    @lang('admin.cms')<span class="caret"></span></a>
            </li>
            @php
                $cms_array = [
                    'teams-management', 'contact_us-management'
                ,'testimonials-management','services-management','ourworks-management','sliders-management'
                ]
            @endphp
            <li class="collapse list-group-level1 {{ in_array($activePage, $cms_array) ? ' show' : '' }}" id="sub-menu1">
                <a href="{{ route('teams.index') }}" class="list-group-item nav-link{{ $activePage == 'teams-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu1">@lang('admin.teams')</a>
                <a href="{{ route('contact_us.index') }}" class="list-group-item nav-link{{ $activePage == 'contact_us-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu1">@lang('admin.contact_us')</a>
                <a href="{{ route('testimonials.index') }}" class="list-group-item nav-link{{ $activePage == 'testimonials-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu1">@lang('admin.testimonials')</a>
                <a href="{{ route('services.index') }}" class="list-group-item nav-link{{ $activePage == 'services-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu1">@lang('admin.services')</a>
                <a href="{{ route('ourworks.index') }}" class="list-group-item nav-link{{ $activePage == 'ourworks-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu1">@lang('admin.ourworks')</a>
                <a href="{{ route('sliders.index') }}" class="list-group-item nav-link{{ $activePage == 'sliders-management' ? ' active' : 'collapsed' }}" data-parent="#sub-menu1">@lang('admin.sliders')</a>
            </li>
            <li class="nav-item{{ $activePage == 'Events' ? ' active' : '' }}">
                <a class="nav-link" href="{{ aurl('/fullcalendar') }}">
                    <i class="material-icons">
                        calendar_today
                    </i>
                    <p>{{ trans('admin.calendar') }}</p>
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
            <li class="nav-item{{ $activePage == 'Logs' ? ' active' : '' }}">
                <a class="nav-link" href="{{ aurl('/log-viewer') }}">
                    <i class="material-icons">
                        error
                    </i>
                    <p>{{ trans('admin.logs') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="material-icons">
                        perm_identity
                    </i>
                    <p>{{ trans('admin.users') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'discount-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('discounts.index') }}">
                    <i class="material-icons">
                        local_offer
                    </i>
                    <p>{{ trans('admin.discounts') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'orders' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('orders.index') }}">
                    <i class="material-icons">
                        library_books
                    </i>
                    <p>{{ trans('admin.orders') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'category-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="material-icons">
                        category
                    </i>
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
            <li class="nav-item{{ $activePage == 'attribute_family-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('attribute_families.index') }}">
                    <i class="material-icons">
                        local_shipping
                    </i>
                    <p>{{ trans('admin.attribute_families') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'product-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="material-icons">
                        shopping_cart
                    </i>
                    <p>{{ trans('admin.products') }}</p>
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
            <li class="nav-item{{ $activePage == 'shippingcompanies-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('shippingcompanies.index') }}">
                    <i class="material-icons">
                        local_shipping
                    </i>
                    <p>{{ trans('admin.shippingcompanies') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'zone-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('zones.index') }}">
                    <i class="material-icons">
                        category
                    </i>
                    <p>{{ trans('admin.zones') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'method-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('methods.index') }}">
                    <i class="material-icons">
                        category
                    </i>
                    <p>{{ trans('admin.method') }}</p>
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
            <li class="nav-item{{ $activePage == 'manufacturers-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('manufacturers.index') }}">
                    <i class="material-icons">
                        local_taxi
                    </i>
                    <p>{{ trans('admin.manufacturers') }}</p>
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
            <li class="nav-item{{ $activePage == 'settings-management' ? ' active' : '' }}">
                <a class="nav-link" href="{{url('languages')}}">
                    <i class="material-icons">
                        language
                    </i>
                    <p>{{ trans('admin.languages') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('table') }}">
                    <i class="material-icons">content_paste</i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'typography' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('typography') }}">
                    <i class="material-icons">library_books</i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('icons') }}">
                    <i class="material-icons">bubble_chart</i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('map') }}">
                    <i class="material-icons">location_ons</i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('notifications') }}">
                    <i class="material-icons">notifications</i>
                    <p>{{ __('NewNotification') }}</p>
                </a>
            </li>
            <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('language') }}">
                    <i class="material-icons">language</i>
                    <p>{{ __('RTL Support') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
