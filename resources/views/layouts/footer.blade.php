<!-- #content -->
@if(!isset($categories))
@php
$categories = \App\Category::where('status', 1)->where('category_id', NULL)
->with('categories')->get();
@endphp
@endif
<footer class="site-footer footer-v1">
    <div class="col-full">
        <div class="before-footer-wrap">
            <div class="col-full">
                {{-- <div class="footer-newsletter">
                    <div class="media">
                        <i class="footer-newsletter-icon tm tm-newsletter"></i>
                        <div class="media-body">
                            <div class="clearfix">
                                <div class="newsletter-header">
                                    <h5 class="newsletter-title">Sign up to Newsletter</h5>
                                    <span class="newsletter-marketing-text">...and receive
                                            <strong>$20 coupon for first shopping</strong>
                                    </span>
                                </div>
                                <!-- .newsletter-header -->
                                <div class="newsletter-body">
                                    <form class="newsletter-form">
                                        <input type="text" placeholder="Enter your email address">
                                        <button class="button" type="button">Sign up</button>
                                    </form>
                                </div>
                                <!-- .newsletter body -->
                            </div>
                            <!-- .clearfix -->
                        </div>
                        <!-- .media-body -->
                    </div>
                    <!-- .media -->
                </div> --}}
                <!-- .footer-newsletter -->
                <div class="footer-social-icons">
                    @if($setting)
                    <ul class="social-icons nav">
                        @if($setting->facebook)
                        <li class="nav-item">
                            <a class="sm-icon-label-link nav-link" href="{{$setting->facebook}}">
                                <i class="fa fa-facebook"></i> @lang('user.facebook')</a>
                        </li>
                        @endif
                        @if($setting->twitter)
                        <li class="nav-item">
                            <a class="sm-icon-label-link nav-link" href="{{$setting->twitter}}">
                                <i class="fa fa-twitter"></i> @lang('user.twitter')</a>
                        </li>
                        @endif
                    </ul>
                    @endif
                </div>
                <!-- .footer-social-icons -->
            </div>
            <!-- .col-full -->
        </div>
        <!-- .before-footer-wrap -->
        <div class="footer-widgets-block">
            <div class="row">
                <div class="footer-contact">
                    <div class="footer-logo">
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
                                <polygon class="cls-1" points="171.63 0.91 171.63 11 170.63 11 170.63 0.91 170.63 0.84 170.63 0.06 176 0.06 176 0.91 171.63 0.91" />
                                <rect class="cls-2" x="166.19" y="0.06" width="3.47" height="0.84" />
                                <rect class="cls-2" x="159.65" y="4.81" width="3.51" height="0.84" />
                                <polygon class="cls-1" points="158.29 11 157.4 11 157.4 0.06 158.26 0.06 158.36 0.06 164.89 0.06 164.89 0.87 158.36 0.87 158.36 10.19 164.99 10.19 164.99 11 158.36 11 158.29 11" />
                                <polygon class="cls-1" points="149.54 6.61 150.25 5.95 155.72 10.98 154.34 10.98 149.54 6.61" />
                                <polygon class="cls-1" points="147.62 10.98 146.65 10.98 146.65 0.05 147.62 0.05 147.62 5.77 153.6 0.33 154.91 0.33 147.62 7.05 147.62 10.98" />
                                <path class="cls-1" d="M156.39,24h-1.25s-0.49-.39-0.71-0.59l-1.35-1.25c-0.25-.23-0.68-0.66-0.68-0.66s0-.46,0-0.72a3.56,3.56,0,0,0,3.54-2.87,3.36,3.36,0,0,0-3.22-4H148.8V24h-1V13.06h5c2.34,0.28,4,1.72,4.12,4a4.26,4.26,0,0,1-3.38,4.34C154.48,22.24,156.39,24,156.39,24Z" transform="translate(-12 -13)" />
                                <polygon class="cls-1" points="132.04 2.09 127.09 7.88 130.78 7.88 130.78 8.69 126.4 8.69 124.42 11 123.29 11 132.65 0 133.04 0 133.04 11 132.04 11 132.04 2.09" />
                                <polygon class="cls-1" points="120.97 2.04 116.98 6.15 116.98 6.19 116.97 6.17 116.95 6.19 116.95 6.15 112.97 2.04 112.97 11 112 11 112 0 112.32 0 116.97 4.8 121.62 0 121.94 0 121.94 11 120.97 11 120.97 2.04" />
                                <ellipse class="cls-3" cx="116.3" cy="22.81" rx="5.15" ry="5.18" />
                                <rect class="cls-2" x="99.13" y="0.44" width="5.87" height="27.12" />
                                <polygon class="cls-1" points="85.94 27.56 79.92 27.56 79.92 0.44 85.94 0.44 85.94 16.86 96.35 16.86 96.35 21.84 85.94 21.84 85.94 27.56" />
                                <path class="cls-1" d="M77.74,36.07a9,9,0,0,0,6.41-2.68L88,37c-2.6,2.74-6.71,4-10.89,4A13.94,13.94,0,0,1,62.89,27.15,14.19,14.19,0,0,1,77.11,13c4.38,0,8.28,1.17,10.89,4,0,0-3.89,3.82-3.91,3.8A9,9,0,1,0,77.74,36.07Z" transform="translate(-12 -13)" />
                                <rect class="cls-2" x="37.4" y="11.14" width="7.63" height="4.98" />
                                <polygon class="cls-1" points="32.85 27.56 28.6 27.56 28.6 5.42 28.6 3.96 28.6 0.44 47.95 0.44 47.95 5.42 34.46 5.42 34.46 22.72 48.25 22.72 48.25 27.56 34.46 27.56 32.85 27.56" />
                                <polygon class="cls-1" points="15.4 27.56 9.53 27.56 9.53 5.57 9.53 0.59 9.53 0.44 24.93 0.44 24.93 5.57 15.4 5.57 15.4 27.56" />
                                <rect class="cls-2" y="0.44" width="7.19" height="5.13" />
                            </svg>
{{--                             <img src='{{$setting?Storage::url($setting->logo):''}}'>
 --}}                        </a>
                    </div>
                    <!-- .footer-logo -->
                    <div class="contact-payment-wrap">
                        <div class="footer-contact-info">
                            <div class="media">
                                            <span class="media-left icon media-middle">
                                                <i class="tm tm-call-us-footer"></i>
                                            </span>
                                <div class="media-body">
                                    <span class="call-us-title">Got Questions ? Call us 24/7!</span>
                                    <span class="call-us-text">{{$setting?$setting->mobile:''}}</span>
                                    <address class="footer-contact-address">{{$setting?$setting->location:''}}</address>

                                </div>
                                <!-- .media-body -->
                            </div>
                            <!-- .media -->
                        </div>
                        <!-- .footer-contact-info -->
                        <div class="footer-payment-info">
                            <div class="media">
                                            <span class="media-left icon media-middle">
                                                <i class="tm tm-safe-payments"></i>
                                            </span>
                                <div class="media-body">
                                    <h5 class="footer-payment-info-title">@lang('user.We_are_using_safe_payments')</h5>
                                    <div class="footer-payment-icons">
                                        <ul class="list-payment-icons nav">
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/mastercard.svg" alt="mastercard" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/visa.svg" alt="visa" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/paypal.svg" alt="paypal" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="payment-icon-image" src="{{url('/')}}/FrontEnd/images/credit-cards/maestro.svg" alt="maestro" />
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- .footer-payment-icons -->
                                    {{-- <div class="footer-secure-by-info">
                                        <h6 class="footer-secured-by-title">Secured by:</h6>
                                        <ul class="footer-secured-by-icons">
                                            <li class="nav-item">
                                                <img class="secure-icons-image" src="{{url('/')}}/FrontEnd/images/secured-by/norton.svg" alt="norton" />
                                            </li>
                                            <li class="nav-item">
                                                <img class="secure-icons-image" src="{{url('/')}}/FrontEnd/images/secured-by/mcafee.svg" alt="mcafee" />
                                            </li>
                                        </ul>
                                    </div> --}}
                                    <!-- .footer-secure-by-info -->
                                </div>
                                <!-- .media-body -->
                            </div>
                            <!-- .media -->
                        </div>
                        <!-- .footer-payment-info -->
                    </div>
                    <!-- .contact-payment-wrap -->
                </div>
                <!-- .footer-contact -->
                <div class="footer-widgets">
                    <div class="columns">
                        <aside class="widget clearfix">
                            <div class="body">
                                <h4 class="widget-title">@lang('user.Find_it_Fast')</h4>
                                <div class="menu-footer-menu-1-container">
                                    <ul id="menu-footer-menu-1" class="menu">
                                        @foreach($categories->take(5) as $category)
                                        <li class="menu-item">
                                            <a href="{{route('show_category', $category->slug)}}">{{$category->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- .menu-footer-menu-1-container -->
                            </div>
                            <!-- .body -->
                        </aside>
                        <!-- .widget -->
                    </div>
                    <!-- .columns -->
                    <div class="columns">
                        <aside class="widget clearfix">
                            <div class="body">
                                <h4 class="widget-title">&nbsp;</h4>
                                <div class="menu-footer-menu-2-container">
                                    <ul id="menu-footer-menu-2" class="menu">
                                        @foreach($categories->skip(5)->take(5) as $category)
                                        <li class="menu-item">
                                            <a href="{{route('show_category', $category->slug)}}">{{$category->name}}</a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- .menu-footer-menu-2-container -->
                            </div>
                            <!-- .body -->
                        </aside>
                        <!-- .widget -->
                    </div>
                    <!-- .columns -->
                    <div class="columns">
                        <aside class="widget clearfix">
                            <div class="body">
                                <h4 class="widget-title">@lang('user.Customer_Care')</h4>
                                <div class="menu-footer-menu-3-container">
                                    <ul id="menu-footer-menu-3" class="menu">
                                        <li class="menu-item">
                                            @auth
                                            <a href="{{route('profile')}}">@lang('user.my_account')</a>
                                            @else
                                            <a href="{{route('login')}}">@lang('user.register')</a>
                                            @endif
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{route('track-your-order')}}">@lang('user.track-your-order')</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{route('shop')}}">@lang('user.Shop')</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{route('show_wishlists')}}">@lang('user.show_wishlists')</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{route('about_us')}}">@lang('user.about_us')</a>
                                        </li>
                                        <li class="menu-item">
                                            <a href="{{route('terms-and-conditions')}}">@lang('user.terms-and-conditions')</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- .menu-footer-menu-3-container -->
                            </div>
                            <!-- .body -->
                        </aside>
                        <!-- .widget -->
                    </div>
                    <!-- .columns -->
                </div>
                <!-- .footer-widgets -->
            </div>
            <!-- .row -->
        </div>
        <!-- .footer-widgets-block -->
        <div class="site-info">
            <div class="col-full">
                <div class="copyright">Copyright &copy; 2017 <a href="home-v1.html">Techmarket</a> Theme. All rights reserved.</div>
                <!-- .copyright -->
                <div class="credit">Made with
                    <i class="fa fa-heart"></i> by bcube.</div>
                <!-- .credit -->
            </div>
            <!-- .col-full -->
        </div>
        <!-- .site-info -->
    </div>

    <!-- .col-full -->
</footer>
<!-- .site-footer -->
</div>

<div id="app"></div>
        <!-- 2. AddChat widget -->
        <div id="addchat_app"
        data-baseurl="{{ url('') }}"
        data-csrfname="{{ 'X-CSRF-Token' }}"
        data-csrftoken="{{ csrf_token() }}"
    ></div>
<style>
    .change_color {
        color:red;
    }
</style>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/jquery.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/tether.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/bootstrap.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/jquery-migrate.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/hidemaxlistitem.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/hidemaxlistitem.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/jquery.easing.min.js"></script>
{{-- <script type="text/javascript" src="{{url('/')}}/FrontEnd/js/scrollup.min.js"></script>
 --}}<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/jquery.waypoints.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/waypoints-sticky.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/pace.min.js"></script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/slick.min.js"></script>
<script type="text/javascript">
    var direction = '{{$direction}}';
    var show_more = '@lang("user.show_more")';
    var show_less = '@lang("user.show_less")';
</script>
<script type="text/javascript" src="{{url('/')}}/FrontEnd/js/scripts.js"></script>
<script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
<script src="{{ url('') }}/js/app.js"></script>
@auth
@role('seller')
    <!-- 3. AddChat JS -->
    <!-- Modern browsers -->
    <script type="module" src="{{ asset('assets/addchat/js/addchat.min.js') }}"></script>
    <!-- Fallback support for Older browsers -->
    <script nomodule src="{{ asset('assets/addchat/js/addchat-legacy.min.js') }}"></script>
@endrole
@endauth
<script>
    var botmanWidget = {
      //  frameEndpoint: '/chatbox',
        aboutText: 'Hello I am Dhaval',
        introMessage: "Hi! How can i help you?",
        mainColor:'#0063D1',
        bubbleBackground: '#0063D1'
    };
</script>
@role('seller')
@else
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
@endrole
@livewireScripts

@push('js')
<script>

    /* Echo.private(`cartupdate`)
    .listen('cartEvent', (e) => {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: e.message,
            showConfirmButton: true,
            timer: 1500
            });
    }); */
    /* $('.change_color').on('click', function () {
        $(this).css('color', )
    }); */
    $('.wish').click(function(){
        $(this).toggleClass('change_color');
    });
    $('a.comp').click(function(){

        $(this).text("@lang('user.already_added')");
    });
</script>
@endpush
@stack('js')
</body>
</html>
