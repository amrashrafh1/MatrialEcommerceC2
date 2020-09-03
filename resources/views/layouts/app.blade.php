@include('layouts.header')

@php

//$direction = (LaravelLocalization::getCurrentLocaleDirection() === 'rtl') ? 'right' :'left';

if(Route::current()->getName() == 'home'){

$bodyClass = 'woocommerce-active page-template-template-homepage-v2 can-uppercase';

} elseif(Route::current()->getName() == 'show_product'){

$bodyClass = 'woocommerce-active single-product full-width extended';

} elseif(Route::current()->getName() == 'show_cart' || Route::current()->getName() == 'contact_us'
|| Route::current()->getName() == 'about_us' || Route::current()->getName() == 'terms-and-conditions'
|| Route::current()->getName() == 'track-your-order') {

$bodyClass = 'page home page-template-default';

} elseif(Route::current()->getName() == 'show_wishlists'){

$bodyClass = 'page-template-default page woocommerce-wishlist can-uppercase';

} elseif(Route::current()->getName() == 'show_checkout') {

$bodyClass = 'woocommerce-active page-template-default woocommerce-checkout woocommerce-page can-uppercase';
} else {
$bodyClass = 'woocommerce-active '. $direction.'-sidebar';
}

@endphp

<body class='{{$bodyClass}}' style='text-align:{{$direction}}'>

    <div id="page" class="hfeed site">
        @include('layouts.top-bar')
        @include('layouts.site-header')
        @yield('content')
        @include('layouts.footer')
