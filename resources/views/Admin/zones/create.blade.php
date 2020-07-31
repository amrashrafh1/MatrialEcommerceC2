@extends('Admin.layouts.app', ['activePage' => 'zones-management', 'titlePage' => trans('admin.zones')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    <div class="col-md-12">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{$error}}</div>
                @endforeach
                @endif
                <div class="widget-extra body-req card light bordered">
                    <div class="card-header card-header-primary">
                        <div class="caption">
                            <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                        </div>
                        <div class="actions">
                            <a href="{{aurl('/zones')}}" class="btn btn-circle btn-icon-only btn-default" tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body form">
                        <div class="col-md-12">
                            {!!
                            Form::open(['url'=>route('zones.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                            form-row-seperated', 'id' =>'create-zones']) !!}
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('name',trans('admin.name'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::text('name',old('name'),['class'=>'form-control name','placeholder'=>trans('admin.name')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" style="height: 150px;">
                                <div class="col-md-2 ">
                                    {!! Form::label('country_id',trans('admin.countries'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::select('country_id[]',\App\Country::pluck('country_name','id'),old('country_id'),['multiple'=>'multiple','class'=>'form-control', 'style'=> 'height:auto'])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row" style="height: 150px;">
                                <div class="col-md-2 ">
                                    {!! Form::label('company_id',trans('admin.shippingCompanies'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::select('company_id[]',\App\ShippingCompany::pluck('name','id'),old('company_id'),['multiple'=>'multiple','class'=>'form-control', 'style'=> 'height:auto'])
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
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator->selector('#create-zones') !!}
@endpush
@stop
