<header id="masthead" class="site-header header-v1" style="background-image: none; ">
    <div class="col-full desktop-only">
        <div class="techmarket-sticky-wrap">
            <div class="row">
                <div class="site-branding">
                    <a href="{{route('home')}}" class="custom-logo-link" rel="home">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 176 28">
                            <defs>
                                <style>
                                    .cls-1,
                                    .cls-2 {
                                        fill: #333e48;
                                    }

                                    .cls-1 {
                                        fill-rule: evenodd;
                                    }

                                    .cls-3 {
                                        fill: #3265b0;
                                    }

                                </style>
                            </defs>
                            <polygon class="cls-1"
                                points="171.63 0.91 171.63 11 170.63 11 170.63 0.91 170.63 0.84 170.63 0.06 176 0.06 176 0.91 171.63 0.91" />
                            <rect class="cls-2" x="166.19" y="0.06" width="3.47" height="0.84" />
                            <rect class="cls-2" x="159.65" y="4.81" width="3.51" height="0.84" />
                            <polygon class="cls-1"
                                points="158.29 11 157.4 11 157.4 0.06 158.26 0.06 158.36 0.06 164.89 0.06 164.89 0.87 158.36 0.87 158.36 10.19 164.99 10.19 164.99 11 158.36 11 158.29 11" />
                            <polygon class="cls-1"
                                points="149.54 6.61 150.25 5.95 155.72 10.98 154.34 10.98 149.54 6.61" />
                            <polygon class="cls-1"
                                points="147.62 10.98 146.65 10.98 146.65 0.05 147.62 0.05 147.62 5.77 153.6 0.33 154.91 0.33 147.62 7.05 147.62 10.98" />
                            <path class="cls-1"
                                d="M156.39,24h-1.25s-0.49-.39-0.71-0.59l-1.35-1.25c-0.25-.23-0.68-0.66-0.68-0.66s0-.46,0-0.72a3.56,3.56,0,0,0,3.54-2.87,3.36,3.36,0,0,0-3.22-4H148.8V24h-1V13.06h5c2.34,0.28,4,1.72,4.12,4a4.26,4.26,0,0,1-3.38,4.34C154.48,22.24,156.39,24,156.39,24Z"
                                transform="translate(-12 -13)" />
                            <polygon class="cls-1"
                                points="132.04 2.09 127.09 7.88 130.78 7.88 130.78 8.69 126.4 8.69 124.42 11 123.29 11 132.65 0 133.04 0 133.04 11 132.04 11 132.04 2.09" />
                            <polygon class="cls-1"
                                points="120.97 2.04 116.98 6.15 116.98 6.19 116.97 6.17 116.95 6.19 116.95 6.15 112.97 2.04 112.97 11 112 11 112 0 112.32 0 116.97 4.8 121.62 0 121.94 0 121.94 11 120.97 11 120.97 2.04" />
                            <ellipse class="cls-3" cx="116.3" cy="22.81" rx="5.15" ry="5.18" />
                            <rect class="cls-2" x="99.13" y="0.44" width="5.87" height="27.12" />
                            <polygon class="cls-1"
                                points="85.94 27.56 79.92 27.56 79.92 0.44 85.94 0.44 85.94 16.86 96.35 16.86 96.35 21.84 85.94 21.84 85.94 27.56" />
                            <path class="cls-1"
                                d="M77.74,36.07a9,9,0,0,0,6.41-2.68L88,37c-2.6,2.74-6.71,4-10.89,4A13.94,13.94,0,0,1,62.89,27.15,14.19,14.19,0,0,1,77.11,13c4.38,0,8.28,1.17,10.89,4,0,0-3.89,3.82-3.91,3.8A9,9,0,1,0,77.74,36.07Z"
                                transform="translate(-12 -13)" />
                            <rect class="cls-2" x="37.4" y="11.14" width="7.63" height="4.98" />
                            <polygon class="cls-1"
                                points="32.85 27.56 28.6 27.56 28.6 5.42 28.6 3.96 28.6 0.44 47.95 0.44 47.95 5.42 34.46 5.42 34.46 22.72 48.25 22.72 48.25 27.56 34.46 27.56 32.85 27.56" />
                            <polygon class="cls-1"
                                points="15.4 27.56 9.53 27.56 9.53 5.57 9.53 0.59 9.53 0.44 24.93 0.44 24.93 5.57 15.4 5.57 15.4 27.56" />
                            <rect class="cls-2" y="0.44" width="7.19" height="5.13" />
                        </svg>
                        {{-- <img src='{{($setting)?Storage::url($setting->logo):''}}' /> --}}
                    </a>
                    <!-- /.custom-logo-link -->
                </div>
                <!-- /.site-branding -->
                <!-- ============================================================= End Header Logo ============================================================= -->
                <nav id="primary-navigation" class="primary-navigation" aria-label="Primary Navigation"
                    data-nav="flex-menu">
                    <ul id="menu-primary-menu" class="nav yamm">
                        <li class="sale-clr yamm-fw menu-item animate-dropdown">
                            <a title="@lang('user.Super_deals')" href="{{route('show_superdeal')}}"
                                style="font-size:13px">@lang('user.Super_deals')</a>
                        </li>
                        <li class="yamm-fw menu-item animate-dropdown">
                            <a title="@lang('user.Sell_on')" href="{{route('seller_app')}}"
                                style="font-size:13px">@lang('user.Sell_on')
                                {{($setting)?$setting->sitename:config('app.APP_NAME')}}</a>
                        </li>
                        @php $menuTitle = \App\CMS::IsExpired()->orderBy('id', 'DESC')->first(); @endphp

                        @if($menuTitle)
                        <li class="menu-item menu-item-has-children animate-dropdown dropdown">
                            <a title="{{($menuTitle->menuTitle)?$menuTitle->menuTitle:''}}" data-toggle="dropdown"
                                class="dropdown-toggle" aria-haspopup="true" href="#"
                                style="font-size:13px">{{($menuTitle)?$menuTitle->menuTitle:''}} <span
                                    class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach(\App\CMS::IsExpired()->get() as $cms)
                                <li class="menu-item animate-dropdown">
                                    <a title="{{$cms->menuTitle}}"
                                        href="{{route('cms_show',$cms->slug)}}">{{$cms->menuTitle}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <!-- .dropdown-menu -->
                        </li>
                        @endif
                        @php
                        $pages = ['about_us','contact_us',
                        'show_wishlists','show_compare','track-your-order','terms-and-conditions','blogs']
                        @endphp
                        <li class="menu-item menu-item-has-children animate-dropdown dropdown">
                            <a title="pages" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true"
                                href="#" style="font-size:13px">@lang('user.pages') <span class="caret"></span></a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach($pages as $index => $page)
                                <li class="menu-item animate-dropdown">
                                    <a title="@lang('user.'.$page)" href="{{route($page)}}">@lang('user.'.$page)</a>
                                </li>
                                @endforeach
                            </ul>
                            <!-- .dropdown-menu -->
                        </li>
                    </ul>
                    <!-- .nav -->
                </nav>
                <!-- .primary-navigation -->
                <nav id="secondary-navigation" class="secondary-navigation" aria-label="Secondary Navigation"
                    data-nav="flex-menu">
                    <ul id="menu-secondary-menu" class="nav">
                        @role('seller')
                        @if(auth()->user()->stores)
                        <li
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2802 animate-dropdown">
                            <a title="@lang('user.seller_dashboard')" data-toggle="modal" data-target="#exampleModal"
                                style='cursor:pointer'>
                                <i class="tm tm-order-tracking"></i>@lang('user.seller_dashboard')</a>
                        </li>
                        @endif
                        @else
                        <li
                            class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2802 animate-dropdown">
                            <a title="@lang('user.Track_Your_Order')" href="{{route('track-your-order')}}">
                                <i class="tm tm-order-tracking"></i>@lang('user.Track_Your_Order')</a>
                        </li>
                        @endrole
                        <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-487 animate-dropdown dropdown">
                            <a title="{{($country) ? $country->country_name : trans('user.select_country')}}"
                                data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" href="#">
                                {{($country) ? $country->country_name : trans('user.select_country')}}
                                <span class="caret"></span>
                            </a>
                            <ul role="menu" class=" dropdown-menu" style='overflow-y:scroll; height:250px;'>
                                @foreach($countries as $country)
                                <li
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-489 animate-dropdown">
                                    <a title="{{ $country->country_name }}"
                                        href="{{'?country=' . $country->country_name}}">{{ $country->country_name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-487 animate-dropdown dropdown">
                            <a title="{{ LaravelLocalization::getCurrentLocaleName() }}
                            " data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true" href="#">
                                {{ LaravelLocalization::getCurrentLocaleName() }}
                                <span class="caret"></span>
                            </a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-489 animate-dropdown">
                                    <a title="{{ $properties['native'] }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                                </li>
                                @endforeach
                            </ul>
                            <!-- .dropdown-menu -->
                        </li>
                        @php
                        $currencies = currency()->getActiveCurrencies();
                        @endphp
                        <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-487 animate-dropdown dropdown">
                            <a title="{{currency()->getUserCurrency()}}" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true" href="#">
                                {{currency()->getUserCurrency()}}
                                <span class="caret"></span>
                            </a>
                            <ul role="menu" class=" dropdown-menu">
                                @foreach($currencies as $currency)
                                <li
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-489 animate-dropdown">
                                    <a title="{{$currency['code']}}"
                                        href="{{URL::current().'?currency='.$currency['code']}}">{{$currency['code']}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <!-- .dropdown-menu -->
                        </li>
                        @guest
                        <li class="menu-item">
                            <a title="My Account" href="{{ url('/login') }}">
                                <i class="tm tm-login-register"></i>@lang('user.register_or_sign_in')</a>
                        </li>
                        @else
                        <li
                            class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-487 animate-dropdown dropdown">
                            <a title="@lang('user.my_account')" data-toggle="dropdown" class="dropdown-toggle"
                                aria-haspopup="true" href="#">
                                <i class="tm tm-login-register"></i>@lang('user.my_account')
                                <span class="caret"></span>
                            </a>
                            <ul role="menu" class=" dropdown-menu">
                                <li
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-489 animate-dropdown">
                                    <a title="Profile" href="{{ url('/profile') }}">@lang('admin.profile')</a>
                                </li>
                                <li
                                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-490 animate-dropdown">
                                    <a title="Profile" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{trans('admin.logout')}}</a>
                                </li>
                            </ul>
                            <!-- .dropdown-menu -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                        @endguest
                        <li class="techmarket-flex-more-menu-item dropdown">
                            <a title="..." href="#" data-toggle="dropdown" class="dropdown-toggle"><i class="fa fa-bars"
                                    aria-hidden="true"></i>
                            </a>
                            <ul class="overflow-items dropdown-menu" style='left:0 !important;'></ul>
                        </li>
                    </ul>
                    <!-- .nav -->
                </nav>
                <!-- .secondary-navigation -->
            </div>
            <!-- /.row -->
        </div>
        <!-- .techmarket-sticky-wrap -->
        @php
        $isHomePage = Route::current()->getName() == 'home'?'show':'';
        @endphp
        <div class="row align-items-center">
            <div id="departments-menu" class="dropdown departments-menu {{$isHomePage}}">
                <button class="btn dropdown-toggle btn-block" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="{{$isHomePage?'true':''}}">
                    <i class="tm tm-departments-thin"></i>
                    <span>@lang('user.All_Departments')</span>
                </button>
                <ul id="menu-departments-menu" class="dropdown-menu yamm departments-menu-dropdown text-{{$direction}} {{$isHomePage}}">
                    @foreach ($categories as $category)
                    @if(count($category->categories))
                    <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown-submenu">
                        <a title="{{ $category->name }}" data-toggle="dropdown" class="dropdown-toggle"
                            aria-haspopup="true" href="#">{{ $category->name }} @if(!empty($category->categories)) <span
                                class="caret"></span> @endif</a>
                        <ul role="menu" class=" dropdown-menu text-{{$direction}}">
                            <li class="menu-item menu-item-object-static_block animate-dropdown">
                                <div class="yamm-content">
                                    <div class="bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                        <div class="kc-col-container">
                                            <div class="kc_single_image">
                                                <img src="{{ Storage::url($category->image) }}" class="" alt="" />
                                            </div>
                                            <!-- .kc_single_image -->
                                        </div>
                                        <!-- .kc-col-container -->
                                    </div>
                                    <!-- .bg-yamm-content -->
                                    <div class="row yamm-content-row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="kc-col-container">
                                                <div class="kc_text_block">
                                                    <!--categories -->
                                                    <ul class='text-{{$direction}}'>
                                                        <li class="nav-title">{{ $category->name }}</li>
                                                        <li><a href="{{ route('show_category',$category->slug) }}">@lang('user.all')
                                                                {{ $category->name }}</a></li>
                                                        @foreach ($category->categories->where('status', 1)->take(12) as
                                                        $child)
                                                        <li><a
                                                                href="{{route('show_category',$child->slug) }}">{{ $child->name }}</a>
                                                        </li>
                                                        @endforeach
                                                        <li class="nav-divider"></li>
                                                        <li>
                                                            <a href="{{route('show_category', $category->slug)}}">
                                                                <span class="nav-text">{{$category->name}}</span>
                                                                <span
                                                                    class="nav-subtext">@lang('user.Discover_more_products')</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- .kc_text_block -->
                                            </div>
                                            <!-- .kc-col-container -->
                                        </div>
                                        <!-- .kc_column -->
                                        <div class="col-md-6 col-sm-12">
                                            <div class="kc-col-container">
                                                <div class="kc_text_block">
                                                    <ul>
                                                        <li class="nav-title"></li>
                                                        @foreach ($category->categories->where('status',
                                                        1)->skip(12)->take(12) as $child)
                                                        <li><a
                                                                href="{{ route('show_category',$child->slug) }}">{{ $child->name }}</a>
                                                        </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <!-- .kc_text_block -->
                                            </div>
                                            <!-- .kc-col-container -->
                                        </div>
                                        <!-- .kc_column -->
                                    </div>
                                    <!-- .kc_row -->
                                </div>
                                <!-- .yamm-content -->
                            </li>
                        </ul>
                    </li>
                    @else
                    <li class="highlight menu-item animate-dropdown">
                        <a title="{{ $category->name }}"
                            href="{{route('show_category',$category->slug) }}">{{ $category->name }}</a>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <!-- .departments-menu -->
            @if(Route::current()->getName() == 'show_seller')
                @livewire('front-end.search-result', ['slug' => Route::current()->parameters['slug']])
            @else
                @livewire('front-end.search-result')
            @endif
            <!-- .navbar-search -->
            @livewire('compare-header')
            <!-- .header-compare -->
            @livewire('wishlist')
            <!-- .header-wishlist -->
            @livewire('cart-header')
        </div>
        <!-- /.row -->
    </div>
    <!-- .col-full -->
    <div class="col-full handheld-only">
        <div class="handheld-header">
            <div class="row">
                <div class="site-branding">
                    <a href="{{route('home')}}" class="custom-logo-link" rel="home">
                        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 176 28">
                            <defs>
                                <style>
                                    .cls-1,
                                    .cls-2 {
                                        fill: #333e48;
                                    }

                                    .cls-1 {
                                        fill-rule: evenodd;
                                    }

                                    .cls-3 {
                                        fill: #3265b0;
                                    }

                                </style>
                            </defs>
                            <polygon class="cls-1"
                                points="171.63 0.91 171.63 11 170.63 11 170.63 0.91 170.63 0.84 170.63 0.06 176 0.06 176 0.91 171.63 0.91" />
                            <rect class="cls-2" x="166.19" y="0.06" width="3.47" height="0.84" />
                            <rect class="cls-2" x="159.65" y="4.81" width="3.51" height="0.84" />
                            <polygon class="cls-1"
                                points="158.29 11 157.4 11 157.4 0.06 158.26 0.06 158.36 0.06 164.89 0.06 164.89 0.87 158.36 0.87 158.36 10.19 164.99 10.19 164.99 11 158.36 11 158.29 11" />
                            <polygon class="cls-1"
                                points="149.54 6.61 150.25 5.95 155.72 10.98 154.34 10.98 149.54 6.61" />
                            <polygon class="cls-1"
                                points="147.62 10.98 146.65 10.98 146.65 0.05 147.62 0.05 147.62 5.77 153.6 0.33 154.91 0.33 147.62 7.05 147.62 10.98" />
                            <path class="cls-1"
                                d="M156.39,24h-1.25s-0.49-.39-0.71-0.59l-1.35-1.25c-0.25-.23-0.68-0.66-0.68-0.66s0-.46,0-0.72a3.56,3.56,0,0,0,3.54-2.87,3.36,3.36,0,0,0-3.22-4H148.8V24h-1V13.06h5c2.34,0.28,4,1.72,4.12,4a4.26,4.26,0,0,1-3.38,4.34C154.48,22.24,156.39,24,156.39,24Z"
                                transform="translate(-12 -13)" />
                            <polygon class="cls-1"
                                points="132.04 2.09 127.09 7.88 130.78 7.88 130.78 8.69 126.4 8.69 124.42 11 123.29 11 132.65 0 133.04 0 133.04 11 132.04 11 132.04 2.09" />
                            <polygon class="cls-1"
                                points="120.97 2.04 116.98 6.15 116.98 6.19 116.97 6.17 116.95 6.19 116.95 6.15 112.97 2.04 112.97 11 112 11 112 0 112.32 0 116.97 4.8 121.62 0 121.94 0 121.94 11 120.97 11 120.97 2.04" />
                            <ellipse class="cls-3" cx="116.3" cy="22.81" rx="5.15" ry="5.18" />
                            <rect class="cls-2" x="99.13" y="0.44" width="5.87" height="27.12" />
                            <polygon class="cls-1"
                                points="85.94 27.56 79.92 27.56 79.92 0.44 85.94 0.44 85.94 16.86 96.35 16.86 96.35 21.84 85.94 21.84 85.94 27.56" />
                            <path class="cls-1"
                                d="M77.74,36.07a9,9,0,0,0,6.41-2.68L88,37c-2.6,2.74-6.71,4-10.89,4A13.94,13.94,0,0,1,62.89,27.15,14.19,14.19,0,0,1,77.11,13c4.38,0,8.28,1.17,10.89,4,0,0-3.89,3.82-3.91,3.8A9,9,0,1,0,77.74,36.07Z"
                                transform="translate(-12 -13)" />
                            <rect class="cls-2" x="37.4" y="11.14" width="7.63" height="4.98" />
                            <polygon class="cls-1"
                                points="32.85 27.56 28.6 27.56 28.6 5.42 28.6 3.96 28.6 0.44 47.95 0.44 47.95 5.42 34.46 5.42 34.46 22.72 48.25 22.72 48.25 27.56 34.46 27.56 32.85 27.56" />
                            <polygon class="cls-1"
                                points="15.4 27.56 9.53 27.56 9.53 5.57 9.53 0.59 9.53 0.44 24.93 0.44 24.93 5.57 15.4 5.57 15.4 27.56" />
                            <rect class="cls-2" y="0.44" width="7.19" height="5.13" />
                        </svg>
                        {{-- <img src='{{($setting)?Storage::url($setting->logo):''}}' /> --}}
                    </a>
                    <!-- /.custom-logo-link -->
                </div>
                <!-- /.site-branding -->
                <!-- ============================================================= End Header Logo ============================================================= -->
                <div class="handheld-header-links">
                    <ul class="columns-4">
                        @guest
                        <li class="my-account">
                            <a href="{{route('login')}}" class="has-icon">
                                <i class="tm tm-login-register"></i>
                            </a>
                        </li>
                        @else
                        <div class="my-account dropdown">
                            <a href='#' class="dropdown-toggle ml-3" id="dropdownMenuProfile" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="tm tm-login-register"></i>
                            </a>
                            <div class="dropdown-menu mt-4" style='margin-right:120px;'
                                aria-labelledby="dropdownMenuProfile">
                                <li class="dropdown-item">
                                    <a title="@lang('user.profile')"
                                        href="{{route('profile')}}">@lang('user.profile')</a>
                                </li>
                                <li class="dropdown-item">
                                    <a title="{{trans('user.seller_dashboard')}}" href="#" data-toggle="modal"
                                        data-target="#exampleModal">{{trans('user.seller_dashboard')}}</a>
                                </li>
                                <li class="dropdown-item">
                                    <a title="{{trans('user.Sell_on').' '. $setting->sitename}}"
                                        href="{{route('seller_app')}}">{{trans('user.Sell_on').' '. $setting->sitename}}</a>
                                </li>
                                <li class="dropdown-item">
                                    <a title="{{trans('user.logout')}}" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{trans('user.logout')}}</a>
                                </li>
                            </div>
                        </div>
                        @endguest
                        <li class="wishlist">
                            <a href="{{route('show_wishlists')}}" class="has-icon">
                                <i class="tm tm-favorites"></i>
                                <span class="count">@guest
                                    0
                                    @else
                                    {{ count(auth()->user()->wishlists) }}
                                    @endauth</span>
                            </a>
                        </li>
                        <li class="compare">
                            <a href="{{route('show_compare')}}" class="has-icon">
                                <i class="tm tm-compare"></i>
                                <span class="count">
                                    @if(session()->get('compare')){{count(session()->get('compare'))}}@else 0 @endif
                                </span>
                            </a>
                        </li>
                        <li class="compare">
                            <a href="{{route('show_chat', ['memberTypeTo'=>'chat', 'seq'=>'asd'])}}" class="has-icon">
                                <i class="tm tm-call-us-footer"></i>
                                <span class="count messages_count">@auth {{auth()->user()->unReadedMessages->count()}}@else 0
                                    @endif</span>
                            </a>
                        </li>

                        <div class="compare dropdown mr-4">
                            <a href='#' class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-flag-o"></i>
                            </a>
                            <div class="dropdown-menu mt-4" aria-labelledby="dropdownMenuButton"
                                style='overflow-y:scroll; height:250px; width:250px;'>
                                @foreach($countries as $country)
                                <li class="dropdown-item">
                                    <a title="{{ $country->country_name }}"
                                        href="{{'?country=' . $country->country_name}}">{{ $country->country_name }}</a>
                                </li>
                                @endforeach
                            </div>
                        </div>

                        <div class="compare dropdown mr-4">
                            <a href='#' class="dropdown-toggle" id="dropdownMenuLang" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-language"></i>

                            </a>
                            <div class="dropdown-menu mt-4" aria-labelledby="dropdownMenuLang">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li class="dropdown-item">
                                    <a title="{{ $properties['native'] }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                                </li>
                                @endforeach
                            </div>
                        </div>

                    </ul>
                    <!-- .columns-3 -->
                </div>
                <!-- .handheld-header-links -->
            </div>
            <!-- /.row -->
            <div class="techmarket-sticky-wrap">
                <div class="row">
                    <nav id="handheld-navigation" class="handheld-navigation" aria-label="Handheld Navigation">
                        <button class="btn navbar-toggler" type="button">
                            <i class="tm tm-departments-thin"></i>
                            <span>Menu</span>
                        </button>
                        <div class="handheld-navigation-menu">
                            <span class="tmhm-close">@lang('user.Close')</span>
                            <ul id="menu-departments-menu-1" class="nav text-{{$direction}}">
                                @foreach($categories as $category)
                                @if(count($category->categories) == 0) <li class="highlight menu-item animate-dropdown">
                                    <a title="{{$category->name}}"
                                        href="{{route('show_category', $category->slug)}}">{{$category->name}}</a>
                                </li>
                                @else
                                <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown dropdown-submenu">
                                    <a title="{{$category->name}}" data-toggle="dropdown" class="dropdown-toggle"
                                        aria-haspopup="true" href="#">{{$category->name}} <span
                                            class="caret"></span></a>
                                    <ul role="menu" class=" dropdown-menu">
                                        <li class="menu-item menu-item-object-static_block animate-dropdown">
                                            <div class="yamm-content">
                                                <div
                                                    class="bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                                    <div class="kc-col-container">
                                                        <div class="kc_single_image">
                                                            <img src="{{Storage::url($category->image)}}" class=""
                                                                alt="" />
                                                        </div>
                                                        <!-- .kc_single_image -->
                                                    </div>
                                                    <!-- .kc-col-container -->
                                                </div>
                                                <!-- .bg-yamm-content -->
                                                <div class="row yamm-content-row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="kc-col-container">
                                                            <div class="kc_text_block">
                                                                <ul>
                                                                    <li class="nav-title">{{$category->name}}</li>
                                                                    @foreach($category->categories->take(8) as $child)
                                                                    <li><a
                                                                            href="{{route('show_category',$child->slug)}}">{{$child->name}}</a>
                                                                    </li>
                                                                    @endforeach
                                                                    <li>
                                                                        <a
                                                                            href="{{route('show_category', $category->slug)}}">
                                                                            <span
                                                                                class="nav-text">{{$category->name}}</span>
                                                                            <span
                                                                                class="nav-subtext">@lang('user.Discover_more_products')</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- .kc_text_block -->
                                                        </div>
                                                        <!-- .kc-col-container -->
                                                    </div>
                                                    <!-- .kc_column -->
                                                    <div class="col-md-6 col-sm-12">
                                                        <div class="kc-col-container">
                                                            <div class="kc_text_block">
                                                                <ul>
                                                                    <li class="nav-title">{{$category->name}}</li>
                                                                    @foreach($category->categories->skip(8)->take(8)
                                                                    as $child)
                                                                    <li><a
                                                                            href="{{route('show_category',$child->slug)}}">{{$child->name}}</a>
                                                                    </li>
                                                                    @endforeach
                                                                    <li>
                                                                        <a
                                                                            href="{{route('show_category', $category->slug)}}">
                                                                            <span
                                                                                class="nav-text">{{$category->name}}</span>
                                                                            <span class="nav-subtext">Discover more
                                                                                products</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <!-- .kc_text_block -->
                                                        </div>
                                                        <!-- .kc-col-container -->
                                                    </div>
                                                    <!-- .kc_column -->
                                                </div>
                                                <!-- .kc_row -->
                                            </div>
                                            <!-- .yamm-content -->
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <!-- .handheld-navigation-menu -->
                    </nav>
                    <!-- .handheld-navigation -->
                    @if(Route::current()->getName() == 'show_seller')
                        @livewire('small-monitor-search', ['slug' => Route::current()->parameters['slug']])
                    @else
                        @livewire('small-monitor-search')
                    @endif
                    <!-- .site-search -->
                    @livewire('small-monitor-cart')
                </div>
                <!-- /.row -->
            </div>
            <!-- .techmarket-sticky-wrap -->
        </div>
        <!-- .handheld-header -->
    </div>
    <!-- .handheld-only -->
</header>
<!-- .header-v1 -->
<!-- Modal -->
@role('seller')
@if(auth()->user()->stores)
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style='z-index:99999999;'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('user.your_stores')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class='row'>
                    @foreach(auth()->user()->stores as $store)
                    <div class='col m-1'
                        style='border:2px solid {{($store->id == session('store'))? '#0063d1':'#999'}};'>
                        <a href='{{route('seller_dashboard', ['store'=> $store->slug])}}'>
                            <img width='180p' height='180' src='{{Storage::url($store->image)}}'>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endrole
