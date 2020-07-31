@include('layouts.header')
@if(Route::current()->getName() == 'home')
<body class="woocommerce-active page-template-template-homepage-v2 can-uppercase">
@elseif(Route::current()->getName() == 'show_product')
<body class="woocommerce-active single-product full-width extended">
@elseif(Route::current()->getName() == 'show_cart')
<body class="page home page-template-default">
@elseif(Route::current()->getName() == 'show_wishlists')
<body class="page-template-default page woocommerce-wishlist can-uppercase">
@elseif(Route::current()->getName() == 'show_checkout')
<body class="woocommerce-active page-template-default woocommerce-checkout woocommerce-page can-uppercase">
@endif
<div id="page" class="hfeed site">
@include('layouts.top-bar')
@include('layouts.site-header')
@yield('content')
@include('layouts.footer')
