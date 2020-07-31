@extends('layouts.app')
@section('content')
<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                <a href="{{route('profile')}}">@lang('user.profile')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div class='w-100'>
                <main id="main" class="site-main">
                    <div class='row w-100'>
                        <div class="col-md-3 nav flex-column nav-pills profile-menu" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill"
                                href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                aria-selected="true">@lang('user.profile')</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-coupons"
                                role="tab" aria-controls="v-pills-coupons" aria-selected="false">@lang('user.coupons')</a>
                            <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders"
                                role="tab" aria-controls="v-pills-orders" aria-selected="false">@lang('user.orders')</a>

                        </div>
                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                @include('FrontEnd.profile.profile')
                            </div>
                            <div class="tab-pane fade" id="v-pills-coupons" role="tabpanel"
                                aria-labelledby="v-pills-coupons-tab">
                                @livewire('front-end.profile.coupons')
                            </div>
                            <div class="tab-pane fade" id="v-pills-orders" role="tabpanel"
                                aria-labelledby="v-pills-orders-tab">
                                @livewire('front-end.profile.orders')
                            </div>

                        </div>
                    </div>
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>

<style>
    .feature .feature-link :hover {
        color: #e6e6e6;

    }

</style>
@push('js')
<script>
$(document).ready(function(){
    $('.profile-menu a.nav-link').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#v-pills-tab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>
@endpush
@endsection
