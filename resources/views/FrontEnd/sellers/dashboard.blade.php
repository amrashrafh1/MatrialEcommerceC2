@extends('layouts.app')
@section('content')

<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>{{auth()->user()->name}} @lang('user.dashboard')
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
                                <img width="416" height="283" alt="" src="{{Storage::url(auth()->user()->image)}}"
                                    class="jumbo-image alignright">
                            </div>
                            <div class="jumbotron-caption">
                                <h3 class="jumbo-title">{{auth()->user()->name}}</h3>
                                <p class="jumbo-subtitle">

                                </p>
                            </div>
                            <!-- .jumbotron-caption -->
                        </div>
                        <!-- .jumbotron -->
                    </div>
                </main>
                <div class="shop-control-bar">
                    <div class="handheld-sidebar-toggle">
                        <button type="button" class="btn sidebar-toggler">
                            <i class="fa fa-sliders"></i>
                            <span>Filters</span>
                        </button>
                    </div>
                    <!-- .handheld-sidebar-toggle -->
                    <h1 class="woocommerce-products-header__title page-title">@lang('user.dashboard')</h1>
                    @include('FrontEnd.sellers.navs')
                    <!-- .shop-view-switcher -->
                    <!-- .techmarket-advanced-pagination -->
                </div>
                @php
                    $user_id = auth()->user()->id;
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
                                    <h2 class="text-primary text-xxl mt-4">{{\App\Sold::whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->sum('sold')}}</h2>
                                    @php
                                    $total_sales_1 =  \App\Sold::whereDate('created_at', today())->whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->sum('sold');
                                    $total_sales_2 = \App\Sold::whereDate('created_at', today()->subDays(6))->whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->sum('sold');
                                    @endphp
                                    @if(getPercentageChange($total_sales_2, $total_sales_1) < 0)
                                    <a href="#" class="btn btn-outline-danger btn-pill btn-sm">{{abs(getPercentageChange($total_sales_2, $total_sales_1))}}% decrease</a>
                                    @else
                                    <a href="#" class="btn btn-outline-success btn-pill btn-sm">{{getPercentageChange($total_sales_2, $total_sales_1)}}% increase</a>
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
                                    <a href="#" class="btn btn-outline-yellow btn-pill btn-sm">10% increase</a>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-cart-arrow-down mr-2"></i>
                                        @lang('user.Total_Orders')
                                    </p>
                                    <h2 class="text-warning text-xxl mt-4">{{\App\Sold::whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->count()}}</h2>

                                    @php
                                    $total_order_1 =  \App\Sold::whereDate('created_at', today())->whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->count();
                                    $total_order_2 = \App\Sold::whereDate('created_at', today()->subDays(6))->whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->count();
                                    @endphp
                                    @if(getPercentageChange($total_order_2, $total_order_1) < 0)
                                    <a href="#" class="btn btn-outline-danger btn-pill btn-sm">{{abs(getPercentageChange($total_order_2, $total_order_1))}}% decrease</a>
                                    @else
                                    <a href="#" class="btn btn-outline-success btn-pill btn-sm">{{getPercentageChange($total_order_2, $total_order_1)}}% increase</a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-signal mr-2"></i>
                                        @lang('user.Total_Revenue')
                                    </p>
                                    <h2 class="text-danger text-xxl mt-4">{!! curr(\App\Sold::whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->sum(\DB::raw('(sale_price * sold) - ((sale_price * sold) * fees / 100) - coupon'))) !!}</h2>
                                    <a href="#" class="btn btn-outline-danger btn-pill btn-sm">10% decrease</a>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-dollar-sign mr-2"></i>
                                        @lang('user.Total_Profit')
                                    </p>
                                    <h2 class="text-success text-xxl mt-4">{!! curr(\App\Sold::whereHas('product', function ($query) use($user_id) {
                                        $query->where('user_id', $user_id);
                                    })->value(\DB::raw('SUM((sale_price * sold - purchase_price * sold) - ((sale_price * sold) * fees / 100) - coupon)'))) !!}</h2>
                                    <a href="#" class="btn btn-outline-success btn-pill btn-sm">5% increase</a>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6" style='border: 1px solid #e6e6e6;'>
                                <div class="text-center">
                                    <p class="text-black">
                                        <i class="fa fa-user-plus mr-2 "></i>
                                        @lang('user.Followers')
                                    </p>
                                    <h2 class="text-primary text-xxl mt-4">{{auth()->user()->followers()->count()}}</h2>
                                    <a href="#" class="btn btn-outline-primary btn-pill btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content mt-5">
                    <div id="grid-extended" class="tab-pane active" role="tabpanel">
                        @livewire('sellers.sales-charts')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
