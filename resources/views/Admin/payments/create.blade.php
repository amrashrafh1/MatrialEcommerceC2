@extends('Admin.layouts.app', ['activePage' => 'payment-management', 'titlePage' => trans('admin.payments')])
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
                    <a href="{{aurl('/payments')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12" id="create-payment">

                    {!!
                    Form::open(['url'=>route('payments.store'),'id'=>'users','class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="payment" class=" control-label">@lang('admin.payment')</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="payment" class="form-control" placeholder="payment" >
                        </div>
                    </div>
                    <br />
                    <div class="form-group row" style="height: 150px;">
                        <div class="col-md-2 ">
                            {!! Form::label('countries',trans('admin.countries'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('countries[]',\App\Country::pluck('country_name','id'),old('countries'),['multiple'=>'multiple','class'=>'form-control', 'style'=> 'height:auto'])
                            !!}
                        </div>
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
@stop
