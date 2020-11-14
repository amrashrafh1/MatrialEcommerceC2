@extends('layouts.app')
@section('content')

<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>{{$store->name}} @lang('user.dashboard')
            </nav>
            @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger"> {{$error}}</div>
            @endforeach
            @endif
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area" style="flex: 0 0 100%;
            max-width: 100%;
            order: 2;">
                <main id="main" class="site-main">
                    <div class="shop-archive-header" wire:ignore>
                        <div class="jumbotron">
                            <div class="jumbotron-img">
                                <img style='background-size:cover;' alt="" src="{{Storage::url($store->image)}}"
                                    class="jumbo-image alignright">
                            </div>
                            <div class="jumbotron-caption">
                                <h3 class="jumbo-title">{{$store->name}}</h3>
                                <p class="jumbo-subtitle">

                                </p>
                            </div>
                            <!-- .jumbotron-caption -->
                        </div>
                        <!-- .jumbotron -->
                    </div>
                </main>
                <div class="">
                    <!-- .handheld-sidebar-toggle -->
                    <h1 class="woocommerce-products-header__title page-title">@lang('user.dashboard')</h1>
                    @include('FrontEnd.sellers.navs', ['slug' => $store->slug])
                    <!-- .shop-view-switcher -->
                    <!-- .techmarket-advanced-pagination -->
                </div>
                @php
                    $user_id = $store->id;
                @endphp
                <div class="tab-content mt-5">
                    <!-- .tab-pane -->
                    <div id="grid-extended" class="tab-pane active" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-line-chart mr-2" aria-hidden="true"></i>
                                        @lang('user.Total_sales')
                                    </p>
                                    <h2 class="text-primary text-xxl mt-4">{{$total_sales}}</h2>
                                    @if($total_sales_percent < 0)
                                    <a href="#" class="btn btn-outline-danger btn-pill btn-sm">{{abs($total_sales_percent)}}% decrease</a>
                                    @else
                                    <a href="#" class="btn btn-outline-success btn-pill btn-sm">{{$total_sales_percent}}% increase</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-users mr-2"></i>
                                        New Users
                                    </p>
                                    <h2 class="text-yellow text-xxl mt-4">523</h2>
                               </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-cart-arrow-down mr-2"></i>
                                        @lang('user.Total_Orders')
                                    </p>
                                    <h2 class="text-warning text-xxl mt-4">{{$total_orders}}</h2>

                                    @if($total_orders_percent < 0)
                                    <a href="#" class="btn btn-outline-danger btn-pill btn-sm">{{abs($total_orders_percent)}}% decrease</a>
                                    @else
                                    <a href="#" class="btn btn-outline-success btn-pill btn-sm">{{$total_orders_percent}}% increase</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-signal mr-2"></i>
                                        @lang('user.Total_Revenue')
                                    </p>
                                    <h2 class="text-danger text-xxl mt-4">${{ $total_revenue }}</h2>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-dollar-sign mr-2"></i>
                                        @lang('user.Total_Profit')
                                    </p>
                                    <h2 class="text-success text-xxl mt-4">{{ $total_profit }}</h2>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-user-plus mr-2 "></i>
                                        @lang('user.Followers')
                                    </p>
                                    <h2 class="text-primary text-xxl mt-4">{{$store->followers()->count()}}</h2>
                                    <a href="#" class="btn btn-outline-primary btn-pill btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content mt-5">
                    <div id="grid-extended" class="tab-pane active" role="tabpanel">
                        @livewire('sellers.sales-charts', ['store' => $store])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
