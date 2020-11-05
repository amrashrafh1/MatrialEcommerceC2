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
                <a href="{{route('seller_dashboard')}}">{{auth()->user()->name}} @lang('user.dashboard')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>@lang('user.create')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area" style="flex: 0 0 100%;
            max-width: 100%;
            order: 2;">
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{$error}}</div>
                @endforeach
                @endif
                @livewire('sellers.product-seller-variations-edit', ['rows'=>$rows])
            </div>
        </div>
    </div>
</div>
@endsection

