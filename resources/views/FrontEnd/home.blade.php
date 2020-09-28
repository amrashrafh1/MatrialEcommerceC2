@extends('layouts.app')
@section('content')
@if(session()->get('success') !== null)
<div class="alert alert-success"> {{session()->get('success')}}</div>
@endif
@include('sweetalert::alert')
@php
    $last_adz = $advertizments->skip(3)->take(1)->first();
    $first_adz = $advertizments->take(1)->first();
@endphp
   <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
            <div class="row">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
                        <div class="slider-with-banners row">
                            <div class="slider-block column-1-slider-block ">
                                <div class="home-v2-slider home-slider">
                                    @foreach($sliders as $index => $slider)

                                    <div class="slider-1" style="background-image: url({{url('/')}}/FrontEnd/images/slider/home-v2-background.jpg);">
                                        <img src="{{Storage::url($slider->image)}}" alt="" style='left:46.4%;bottom:0'>
                                        <div class="caption">
                                            <div class="title">{{$slider->header}}
                                            </div>
                                            <div class="sub-title">{{$slider->body}}</div>
                                            <a href='{{$slider->link}}' class="button">@lang('user.Browse_now')
                                                <i class="tm tm-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="banners-block column-2-banners-block">
                                @if($first_adz)
                                <div class="banner text-in-left">
                                    <a href="shop.html">
                                        <div style="background-size: cover; background-position: center center; background-image: url( {{Storage::url($first_adz->image)}} ); height: 256px;" class="banner-bg">
                                            <div class="caption">
                                                <div class="banner-info">
                                                    <h3 class="title">
                                                    {{$first_adz->header}}</h3>
                                                </div>
                                                <!-- .banner-info -->
                                            </div>
                                            <!-- .caption -->
                                        </div>
                                        <!-- .banner-bg -->
                                    </a>
                                </div>
                                @endif
                                <!-- .banner -->
                                @if($randomProduct)
                                <div class="banner text-in-left">
                                    <a href="{{route('show_product', $randomProduct->slug)}}">
                                        <div style="background-size: cover; background-position: center center; background-image: url( {{Storage::url($randomProduct->image)}} ); height: 256px;" class="banner-bg">
                                            <div class="caption">
                                                <div class="banner-info">
                                                    <h3 class="title">
                                                        {{$randomProduct->name}}
                                                    </h3>
                                                </div>
                                                <!-- .banner-info -->
                                                <span class="price">
                                                    @if($randomProduct->available_discount())
                                                    <ins>
                                                        <span class="amount">{!! curr($randomProduct->priceDiscount()) !!}</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">{!! curr($randomProduct->calc_price()) !!}</span>
                                                    </del>
                                                    @else
                                                    <ins>
                                                        <span class="amount">{!! curr($randomProduct->calc_price()) !!}</span>
                                                    </ins>
                                                @endif
                                                </span>
                                                <span class='product_shipping'>{{product_shipping($randomProduct)}}</span>

                                            </div>
                                            <!-- .caption -->
                                        </div>
                                        <!-- .banner-bg -->
                                    </a>
                                </div>
                                @endif
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
                                @if($advertizments->count() >= 1)
                                @foreach($advertizments->skip(1)->take(3) as $index => $adz)
                                <div class="banner @if($index == 0 || $index == 2) small-banner text-in-left @else large-banner text-in-right @endif">
                                    <a href="#">
                                        <div class="banner-bg" style="background-size: cover; background-position: center center; background-image: url( {{Storage::url($adz->image)}} ); height: 259px;">
                                            <div class="caption">
                                                <div class="banner-info">
                                                    <h3 class="title">
                                                        {{$adz->header}}
                                                    </h3>
                                                </div>
                                            <a href="{{$adz->link}}" class="banner-action button">@lang('user.View_all')</a>
                                            </div>
                                            <!-- /.caption -->
                                        </div>
                                    </a>
                                </div>
                                @endforeach
                                @endif
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
                        @if($last_adz)
                        <div class="banner full-width-banner">
                            <a href="shop.html">
                                <div style="background-size: cover; background-position: center center; background-image: url( {{Storage::url($last_adz->image)}} ); height: 236px;" class="banner-bg">
                                    <div class="caption">
                                        <div class="banner-info">
                                            <h3 class="title">
                                                {{$last_adz->header}}
                                        </div>
                                        <a href='{{$last_adz->link}}' class="banner-action button">@lang('user.Browse_now')
                                                    <i class="feature-icon d-flex ml-4 tm tm-long-arrow-right"></i>
                                        </a>
                                    </div>
                                    <!-- /.caption -->
                                </div>
                                <!-- /.banner-b -->
                            </a>
                            <!-- /.section-header -->
                        </div>
                        @endif
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
