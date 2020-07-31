@extends('layouts.app')
@section('content')
@if(session()->get('success') !== null)
<div class="alert alert-success"> {{session()->get('success')}}</div>
@endif
@include('sweetalert::alert')
   <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="row">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <div class="slider-with-banners row">
                            <div class="slider-block column-1-slider-block ">
                                <div class="home-v2-slider home-slider">
                                    @foreach(\App\CMS::isExpired() as $cms)
                                    <div class="slider-1" style="background-image: url({{ url('/') }}/FrontEnd/images/slider/background-cement-concrete-paint-242236.jpg);">
                                        <img src="{{Storage::url($cms->image)}}" alt="">
                                        <div class="caption">
                                        <div class="title">{{$cms->menuTitle}}</div>
                                            <div class="sub-title">{{$cms->title}}</div>
                                        <a class="button" href="{{route('cms_show',$cms->slug)}}">Browse now
                                                <i class="tm tm-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="banners-block column-2-banners-block">
                                <div class="banner text-in-left">
                                    <a href="shop.html">
                                        <div style="background-size: cover; background-position: center center; background-image: url( {{ url('/') }}/FrontEnd/images/banner/2-1.jpg ); height: 256px;" class="banner-bg">
                                            <div class="caption">
                                                <div class="banner-info">
                                                    <h3 class="title">
                                                        <strong>20% Off Tech</strong>
                                                        <br> at Ultrabooks,
                                                        <br> Laptops, Tablets
                                                        <br>Notebooks &amp;
                                                        <br>More</h3>
                                                </div>
                                                <!-- .banner-info -->
                                            </div>
                                            <!-- .caption -->
                                        </div>
                                        <!-- .banner-bg -->
                                    </a>
                                </div>
                                <!-- .banner -->
                                <div class="banner text-in-left">
                                    <a href="shop.html">
                                        <div style="background-size: cover; background-position: center center; background-image: url( {{ url('/') }}/FrontEnd/images/banner/2-2.jpg ); height: 256px;" class="banner-bg">
                                            <div class="caption">
                                                <div class="banner-info">
                                                    <h4 class="pretitle">Best Gift Idea</h4>
                                                    <h3 class="title">Mini Two Wheel
                                                        <br>
                                                        <strong>Self Balancing</strong>
                                                        <br> Scooter</h3>
                                                </div>
                                                <!-- .banner-info -->
                                                <span class="price">
                                                            <ins>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">£</span>339.99</span>
                                                            </ins>
                                                            <del>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">£</span>689</span>
                                                            </del>
                                                        </span>
                                            </div>
                                            <!-- .caption -->
                                        </div>
                                        <!-- .banner-bg -->
                                    </a>
                                </div>
                                <!-- .banner -->
                            </div>
                            <!-- .banners-block -->
                        </div>
                        <section class="section-top-categories section-categories-carousel" id="categories-carousel-3">
                            <header class="section-header">
                                <h2 class="section-title">@lang('user.top_categories_this_week')</h2>
                                <a class="readmore-link" href="{{ url('/shop') }}">@lang('user.full_catalog')</a>
                            </header>
                            <!-- .section-header -->
                            <div class="product-categories product-categories-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#categories-carousel-3 .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}},{&quot;breakpoint&quot;:1700,&quot;settings&quot;:{&quot;slidesToShow&quot;:6,&quot;slidesToScroll&quot;:6}}]}">
                                <div class="woocommerce columns-7">
                                    <div class="products">
                                        @foreach($catalog
                                        ->where('status', 1) as $category)
                                            <div class="product-category product">
                                                <a href="{{route('show_category',$category->slug)}}">
                                                    <img width="224" height="197" style="height:197px;width:224px;" src="{{ Storage::url($category->image) }}">
                                                    <h2 class="woocommerce-loop-category__title"> {{ $category->name }} </h2>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- .products-->
                                </div>
                                <!-- .woocommerce-->
                            </div>
                            <!-- .product-categories -->
                        </section>
                        @livewire('deals')
                        <div class="fullwidth-notice stretch-full-width">
                            <div class="col-full">
                                <p class="message">Download our new app today! Dont miss our mobile-only offers and shop with Android Play.</p>
                            </div>
                            <!-- .col-full -->
                        </div>
                        <!-- .fullwidth-notice -->
                        <div class="banners">
                            <div class="row">
                                @php
                                    $adz =\App\Product::where('visible', 'visible')->latest()->first();
                                @endphp
                                <div class="banner small-banner text-in-left">
                                    <a href="#">
                                        <div class="banner-bg" style="background-size: cover; background-position: center center; background-image: url( {{ url('/') }}/FrontEnd/img/megamenu-1.jpg ); height: 259px;">
                                            <div class="caption">
                                                <div class="banner-info">
                                                    <h3 class="title">@lang('user.New_Arrivals')
                                                        <br> @lang('user.in')
                                                        <strong>@lang('user.Accessories')</strong>
                                                        <br> @lang('user.at_Best_Prices.')</h3>
                                                </div>
                                            <a href="{{route('shop')}}" class="banner-action button">@lang('user.View_all')</a>
                                            </div>
                                            <!-- /.caption -->
                                        </div>
                                    </a>
                                </div>
                                <!-- /.banner -->
                                <div class="banner large-banner text-in-right">
                                    <a href="#">
                                        <div class="banner-bg" style="background-size: cover; background-position: center center; background-image: url( {{ url('/') }}/FrontEnd/images/banner/3-4.jpg ); height: 259px;">
                                            <div class="caption">
                                                <div class="banner-info">
                                                    <h3 class="title">Catch Hottest
                                                        <br>
                                                        <strong>Deals</strong> on the
                                                        <br> Curved Soundbars.</h3>
                                                </div>
                                                <span class="banner-action button">Browse</span>
                                            </div>
                                            <!-- /.caption -->
                                        </div>
                                    </a>
                                </div>
                                <!-- /.banner -->
                                <div class="banner small-banner text-in-left">
                                    @if($adz)
                                    <a href="#">
                                        <div class="banner-bg" style="background-size: cover; background-position: center center; background-image: url( {{Storage::url($adz->image)}} ); height: 259px;">
                                            <div class="caption ">
                                                <div class="banner-info">
                                                    <h3 class="title">
                                                        <p class='text-white'>{{$adz->name}}</p>
                                                </div>
                                                @if(isset($adz->discount))
                                                <ins class='text-white'>
                                                    <span class="amount">{!! curr($adz->priceDiscount()) !!}</span>
                                                </ins>
                                                <del class='text-white'>
                                                    <span class="amount">{!! curr($adz->sale_price) !!}</span>
                                                </del>
                                                @else
                                                <ins class='text-white'>
                                                    <span class="amount">{!! curr($adz->sale_price) !!}</span>
                                                </ins>
                                                @endif
                                            <a href="{{route('show_product',$adz->slug)}}" class="banner-action button">@lang('user.Buy_Now')</a>
                                            </div>
                                            <!-- /.caption -->
                                        </div>
                                    </a>
                                    @endif
                                </div>
                                <!-- /.banner -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.banners -->
                        @livewire('new-arrivals')
                        <!-- .section-products-carousel-tabs -->
                        @livewire('special-offers')

                        @livewire('trending-now')
                        <!-- .section-products-carousel -->
                        <div class="banner full-width-banner">
                            <a href="shop.html">
                                <div style="background-size: cover; background-position: center center; background-image: url( {{ url('/') }}/FrontEnd/images/banner/full-width.png ); height: 236px;" class="banner-bg">
                                    <div class="caption">
                                        <div class="banner-info">
                                            <h3 class="title">
                                                <strong>Extremely Portable</strong>, learn
                                                <br> to ride in just 3 minutes</h3>
                                            <h4 class="subtitle">Travel up to 22km in a single charge</h4>
                                        </div>
                                        <span class="banner-action button">Browse now
                                                    <i class="feature-icon d-flex ml-4 tm tm-long-arrow-right"></i>
                                                </span>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.banner-b -->
                            </a>
                            <!-- /.section-header -->
                        </div>
                        <!-- /.banner -->
                        @livewire('dreams')
                        <!-- .section-products-carousel-with-bg -->
                        @livewire('hand-picked')
                        <!-- .section-products-carousel-widget-with-tabs -->
                        @livewire('brands')
                        <!-- .brands-carousel -->
                        @livewire('products.recently-product')

                        <!-- .section-landscape-products-carousel -->
                    </main>
                    <!-- #main -->
                </div>
                <!-- #primary -->
            </div>
            <!-- .row -->
        </div>
        <!-- .col-full -->
    </div>
@endsection
