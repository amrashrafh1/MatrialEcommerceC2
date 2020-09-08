@extends('layouts.app')

@section('content')
<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.Track_Order')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                     {{$error}}
                </div>
                @endforeach
            @endif
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="type-page hentry">
                        <header class="entry-header">
                            <div class="page-header-caption">
                                <h1 class="entry-title">@lang('user.Track_Order')</h1>
                            </div>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <div class="woocommerce">
                                {!! Form::open(['url' => route('track-your-order-send'), 'class'=> 'track_order']) !!}
                                <p>@lang('user.To_track_your_order_please_enter_your_Order_ID_in_the_box_below_and_press_the_"Track"_button._This_was_given_to_you_on_your_receipt_and_in_the_confirmation_email_you_should_have_received.')
                                </p>
                                <p class="form-row form-row-first">
                                    <label for="orderid">@lang('user.Order_Id')</label>
                                    {!! Form::text('orderid', old('orderid'), ['class' => 'input-text', 'id' =>
                                    'orderid', 'placeholder' => trans('user.Found_in_your_order_confirmation_email.')])
                                    !!}
                                </p>
                                <p class="form-row form-row-last">
                                    <label for="order_email">@lang('user.Billing_email')</label>
                                    {!! Form::email('order_email', old('order_email'), ['class' => 'input-text', 'id' =>
                                    'order_email', 'placeholder' => trans('user.Email_you_used_during_checkout.')]) !!}
                                </p>
                                <div class="clear"></div>
                                <p class="form-row">
                                    <input type="submit" class="button" name="track" value="@lang('user.track')" />
                                </p>
                                {!! Form::close() !!}
                                <!-- .track_order -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .entry-content -->
                    </div>
                    <!-- .hentry -->
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
