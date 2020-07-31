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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="invoice-title">
                                <h3 class="">@lang('admin.order') # {{$order->id}}</h3>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>@lang('admin.customer'): </strong><br>
                                        {{$order->billing_name}}<br>
                                        {{$order->billing_email}}<br>
                                        {{$order->billing_phone}}<br>
                                    </address>
                                    <address>
                                        <strong>@lang('admin.billed_to'):</strong><br>
                                        {{$order->billing_address}}<br/>
                                        {{$order->billing_address_two}}<br/>
                                        {{$order->billing_address_three}}
                                    </address>
                                </div>
                                <div class="col-sm-6 text-right">
                                    @if(empty($order->shipping_name) && empty($order->shipping_email) && empty($order->shipping_phone))
                                    @elseif(!empty($order->shipping_name) || !empty($order->shipping_email) || !empty($order->shipping_phone))
                                    <address>
                                        <strong>@lang('admin.customer'): </strong><br>
                                            {{$order->shipping_name}}<br>
                                            {{$order->shipping_email}}<br>
                                            {{$order->shipping_phone}}<br>
                                    </address>
                                    @endif
                                    <address>
                                        <strong>@lang('admin.shipped_to'):</strong><br>
                                        @if(empty($order->shipping_address))
                                            {{$order->billing_email}}<br>
                                            {{$order->billing_address}}<br/>
                                            {{$order->billing_address_two}}<br/>
                                            {{$order->billing_address_three}}
                                        @else
                                            {{$order->shipping_email}}<br>
                                            {{$order->shipping_address}}<br/>
                                            {{$order->shipping_address_two}}<br/>
                                            {{$order->shipping_address_three}}
                                        @endif
                                    </address>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>@lang('admin.payment_method'):</strong><br>
                                        {{($order->payment_method)?$order->payment_method:'null'}}<br>
                                        {{$order->billing_email}}
                                    </address>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <address>
                                        <strong>@lang('admin.order_date'):</strong><br>
                                        {{$order->created_at}}<br><br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>@lang('admin.order_summary')</strong></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-condensed">
                                            <thead>
                                            <tr>
                                                <td><strong>@lang('admin.item')</strong></td>
                                                <td class="text-center"><strong>@lang('admin.price')</strong></td>
                                                <td class="text-center"><strong>@lang('admin.quantity')</strong></td>
                                                <td class="text-right"><strong>@lang('admin.totals')</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            @php
                                                $total    = 0;
                                                $shipping = 0;
                                                $tax      = 0;
                                                @endphp
                                            @foreach($order->order_lines as $item)
                                            <tr>
                                                <td>{{$item->product}}</td>
                                                <td class="text-center">${{$item->price}}</td>
                                                <td class="text-center">{{$item->quantity}}</td>
                                                <td class="text-right">{{$item->price * $item->quantity}}</td>
                                            </tr>
                                                @php
                                                    $total    += floatval($item->price * $item->quantity);
                                                    $tax      += floatval($item->tax);
                                                    @endphp
                                            @endforeach
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>@lang('admin.Subtotal')</strong></td>
                                                <td class="thick-line text-right">${{$total}}</td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Shipping</strong></td>
                                                <td class="no-line text-right">${{$order->shipping_total}}</td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Coupon</strong></td>
                                                <td class="no-line text-right">${{$order->coupon}}</td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Tax</strong></td>
                                                <td class="no-line text-right">${{$tax}}</td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Total</strong></td>
                                                <td class="no-line text-right">${{$order->grand_total}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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


@endsection
