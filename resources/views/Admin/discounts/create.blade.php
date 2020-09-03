@extends('Admin.layouts.app', ['activePage' => 'discount-management', 'titlePage' => trans('admin.discounts')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    <div class="col-md-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{$error}}</div>
        @endforeach
        @endif
        <div class="widget-extra body-req card light bordered">
            <div class="card-header">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a href="{{aurl('/discounts')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!!
                    Form::open(['url'=>route('discounts.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
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
                            'fixed_amount'                => trans('admin.fixed_amount'),
                            'buy_x_and_get_y_free'        => trans('admin.buy_x_and_get_y_free')
                            ],old('condition'),['class'=>'form-control','id'=>'condition','placeholder'=>trans('admin.condition')])
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
                            ],old('daily'),['class'=>'form-control','id'=>'daily','placeholder'=>trans('admin.daily_deals_section')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('start_at',trans('admin.start_at'),['class'=>'
                        control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::dateTime('start_at',old('start_at'),['class'=>'form-control datetimepicker','placeholder'=>trans('admin.start_at')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('expire_at',trans('admin.expire_at'),['class'=>'
                        control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::dateTime('expire_at',old('expire_at'),['class'=>'form-control datetimepicker','placeholder'=>trans('admin.expire_at')])
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
                            {!!
                            Form::number('amount',old('amount'),['class'=>'form-control','placeholder'=>trans('admin.amount')])
                            !!}
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
                            Form::number('max_quantity',old('max_quantity'),['class'=>'form-control','placeholder'=>trans('admin.max_quantity')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div id='product_id'>
                        @livewire('admin.discount.product-id', ['type'=>'product_id'])
                    </div>
                    <div class="form-group row" id="buy_x_quantity">
                        <div class="col-md-2">
                            {!! Form::label('buy_x_quantity',trans('admin.buy_x_quantity'),['class'=>'
                        control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::number('buy_x_quantity',old('buy_x_quantity'),['class'=>'form-control','placeholder'=>trans('admin.buy_x_quantity')])
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
                            Form::number('y_quantity',old('y_quantity'),['class'=>'form-control','placeholder'=>trans('admin.y_quantity')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div id='product_y'>
                        @livewire('admin.discount.product-id', ['type'=>'product_y'])
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

@push('js')
<link href="{{ url('/') }}/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<script src="{{ url('/') }}/js/bootstrap-material-datetimepicker.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>
$('#condition').each(function () {
    if($(this).val() == 'buy_x_and_get_y_free') {
        $('#buy_x_quantity').show();
        $('#y_quantity').show();
        $('#product_y').show();
        $('#product_id').show();

    } else if ($(this).val() == 'fixed_amount_for_whole_cart') {
        $('#buy_x_quantity').hide();
        $('#y_quantity').hide();
        $('#product_y').hide();
        $('#product_id').hide();
    }else {
        $('#buy_x_quantity').hide();
        $('#y_quantity').hide();
        $('#product_y').hide();
        $('#product_id').show();

    }
});
$('#condition').on('change', function () {
    if($(this).val() == 'buy_x_and_get_y_free') {
        $('#buy_x_quantity').show();
        $('#y_quantity').show();
        $('#product_y').show();
        $('#product_id').show();

    } else if ($(this).val() == 'fixed_amount_for_whole_cart') {
        $('#buy_x_quantity').hide();
        $('#y_quantity').hide();
        $('#product_y').hide();
        $('#product_id').hide();
    }else {
        $('#buy_x_quantity').hide();
        $('#y_quantity').hide();
        $('#product_y').hide();
        $('#product_id').show();

    }
});
$('.datetimepicker').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', minDate : new Date() });
$('.js-example-basic-single').select2();

</script>
@endpush
@stop
