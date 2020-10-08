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
                <div class="widget-extra body-req card light bordered">
                    <div class="card-header">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">@lang('user.add_discount')</span>
                        </div>
                        <div class="actions">
                            <a href="{{route('seller_frontend_products')}}" class="btn btn-circle btn-icon-only btn-default"
                                tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body form">
                        <div class="col-md-12">
                            {!!
                            Form::open(['url'=>route('seller_discount_update',$rows->id),'id'=>'users','class'=>'form-horizontal
                            form-row-seperated']) !!}
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('condition',trans('admin.condition'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    {!!
                                    Form::select('condition',[
                                    'percentage_of_product_price' => trans('admin.percentage_of_product_price'),
                                    'fixed_amount' => trans('admin.fixed_amount'),
                                    'buy_x_and_get_y_free' => trans('admin.buy_x_and_get_y_free')
                                    ],$rows->discount->condition,['class'=>'form-control','id'=>'condition','placeholder'=>trans('admin.condition')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('daily',trans('admin.daily_deals_section'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    {!!
                                    Form::select('daily',[
                                    'none'=> trans('admin.none'),'daily_deals' => trans('admin.daily_deals_section')
                                    ,'special_offers' => trans('admin.special_offers_section')
                                    ],$rows->discount->daily,['class'=>'form-control','id'=>'daily','placeholder'=>trans('admin.daily_deals_section')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('start_at',trans('user.expire_at'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    {!!
                                    Form::datetimeLocal('start_at',\Carbon\Carbon::parse($rows->discount->start_at)->format('Y-m-d\TH:i'),['class'=>'form-control
                                    datetimepicker','placeholder'=>trans('admin.start_at')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('expire_at',trans('user.expire_at'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    {!!
                                    Form::datetimeLocal('expire_at',\Carbon\Carbon::parse($rows->discount->expire_at)->format('Y-m-d\TH:i'),['class'=>'form-control
                                    datetimepicker','placeholder'=>trans('admin.expire_at')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('amount',trans('admin.amount'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    <input name="amount" type="number" class="form-control" step="0.00"
                                    placeholder="@lang('admin.amount')" value="{{$rows->discount->amount}}">
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('max_quantity',trans('admin.max_quantity'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    {!!
                                    Form::number('max_quantity',$rows->discount->max_quantity,['class'=>'form-control','placeholder'=>trans('admin.max_quantity')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" id="buy_x_quantity">
                                <div class="col-md-2">
                                    {!! Form::label('buy_x_quantity',trans('admin.buy_x_quantity'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    {!!
                                    Form::number('buy_x_quantity',$rows->discount->buy_x_quantity,['class'=>'form-control','placeholder'=>trans('admin.buy_x_quantity')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" id="y_quantity">
                                <div class="col-md-2">
                                    {!! Form::label('y_quantity',trans('admin.y_quantity'),['class'=>'
                                    control-label']) !!}
                                </div>
                                <div class="col-md-9">
                                    {!!
                                    Form::number('y_quantity',$rows->discount->y_quantity,['class'=>'form-control','placeholder'=>trans('admin.y_quantity')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div id='product_y'>
                                @livewire('admin.discount.edit-product-id', ['type'=>'product_y','id' => $rows->product_y, 'owner' => 'for_seller'])
                            </div>
                            <br>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-offset-3 col-md-9">
                                                {!! Form::submit(trans('admin.add'),['class'=>'btn btn-success']) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('js')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
    $('#condition').each(function () {
        if ($(this).val() == 'buy_x_and_get_y_free') {
            $('#buy_x_quantity').show();
            $('#y_quantity').show();
            $('#product_y').show();
            $('#product_id').show();

        } else if ($(this).val() == 'fixed_amount_for_whole_cart') {
            $('#buy_x_quantity').hide();
            $('#y_quantity').hide();
            $('#product_y').hide();
            $('#product_id').hide();
        } else {
            $('#buy_x_quantity').hide();
            $('#y_quantity').hide();
            $('#product_y').hide();
            $('#product_id').show();

        }
    });
    $('#condition').on('change', function () {
        if ($(this).val() == 'buy_x_and_get_y_free') {
            $('#buy_x_quantity').show();
            $('#y_quantity').show();
            $('#product_y').show();
            $('#product_id').show();

        } else if ($(this).val() == 'fixed_amount_for_whole_cart') {
            $('#buy_x_quantity').hide();
            $('#y_quantity').hide();
            $('#product_y').hide();
            $('#product_id').hide();
        } else {
            $('#buy_x_quantity').hide();
            $('#y_quantity').hide();
            $('#product_y').hide();
            $('#product_id').show();

        }
    });
    $('.js-example-basic-single').select2();

</script>
@endpush
@stop
