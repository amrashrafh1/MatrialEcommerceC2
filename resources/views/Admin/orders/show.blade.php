@extends('Admin.layouts.app', ['activePage' => 'orders', 'titlePage' => trans('admin.orders')])
@section('content')

<div class="container-fluid pt-8 mt-5">
    <div class="col-md-12">
        <div class="card light bordered">
            <div class="card-header">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
            </div>
            <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="invoice-title">
                    <h3 class="">@lang('admin.order') # {{$rows->id}}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong>@lang('admin.customer'): </strong><br>
                            {{$rows->billing_name}}<br>
                            {{$rows->billing_email}}<br>
                            {{$rows->billing_phone}}<br>
                        </address>
                        <address>
                            <strong>@lang('admin.billed_to'):</strong><br>
                            {{$rows->billing_address}}<br/>
                            {{$rows->billing_address_two}}<br/>
                            {{$rows->billing_address_three}}
                        </address>
                    </div>
                    <div class="col-sm-6 text-right">
                        @if(empty($rows->shipping_name) && empty($rows->shipping_email) && empty($rows->shipping_phone))
                        @elseif(!empty($rows->shipping_name) || !empty($rows->shipping_email) || !empty($rows->shipping_phone))
                        <address>
                            <strong>@lang('admin.customer'): </strong><br>
                                {{$rows->shipping_name}}<br>
                                {{$rows->shipping_email}}<br>
                                {{$rows->shipping_phone}}<br>
                        </address>
                        @endif
                        <address>
                            <strong>@lang('admin.shipped_to'):</strong><br>
                            @if(empty($rows->shipping_address))
                                {{$rows->billing_email}}<br>
                                {{$rows->billing_address}}<br/>
                                {{$rows->billing_address_two}}<br/>
                                {{$rows->billing_address_three}}
                            @else
                                {{$rows->shipping_email}}<br>
                                {{$rows->shipping_address}}<br/>
                                {{$rows->shipping_address_two}}<br/>
                                {{$rows->shipping_address_three}}
                            @endif
                        </address>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <address>
                            <strong>@lang('admin.payment_method'):</strong><br>
                            <span class='text-capitalize'>
                                {{$rows->payment_method}}
                            </span>
                        </address>
                    </div>
                    <div class="col-sm-6 text-right">
                        <address>
                            <strong>@lang('admin.order_date'):</strong><br>
                            {{$rows->created_at}}<br><br>
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
                                    <td class="text-center"><strong>@lang('admin.discount')</strong></td>
                                    <td class="text-center"><strong>@lang('admin.quantity')</strong></td>
                                    <td class="text-right"><strong>@lang('admin.totals')</strong></td>
                                </tr>
                                </thead>
                                <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                @php
                                    $total    = 0;
                                    $shipping = 0;
                                    @endphp
                                @foreach($rows->order_lines as $item)
                                <tr>
                                    <td>{{$item->product}}</td>
                                    <td class="text-center">${{$item->price}}</td>
                                    <td class="text-center">-(${{$item->discount}})</td>
                                    <td class="text-center">{{$item->quantity}}</td>
                                    <td class="text-right">{{($item->price * $item->quantity)}}</td>
                                </tr>
                                    @php
                                        $total    += floatval($item->price * $item->quantity);
                                        @endphp
                                @endforeach
                                <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>@lang('admin.Subtotal')</strong></td>
                                    <td class="thick-line text-right">${{$rows->sub_total}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Shipping</strong></td>
                                    <td class="no-line text-right">${{$rows->shipping_total}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Coupon</strong></td>
                                    <td class="no-line text-right">${{$rows->coupon}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">${{$rows->grand_total}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>
</div>
    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>
@stop
