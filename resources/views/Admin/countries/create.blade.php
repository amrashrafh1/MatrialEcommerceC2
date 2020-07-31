@extends('Admin.layouts.app', ['activePage' => 'country-management', 'titlePage' => trans('admin.countries')])
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
                    <a href="{{aurl('/countries')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!!
                    Form::open(['url'=>route('countries.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('name',trans('admin.name') .' ('. $properties['native'] .
                            ')',['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('country_name_'.$localeCode,old('name'),['class'=>'form-control
                            name_'.$localeCode,'placeholder'=>trans('admin.name') .' ('. $properties['native'] .
                            ')'])
                            !!}
                        </div>
                    </div>
                    <br>
                    @endforeach
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('mob',trans('admin.mob'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::text('mob',old('mob'),['class'=>'form-control','placeholder'=>trans('admin.mob')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('code',trans('admin.code_country'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::text('code',old('code'),['class'=>'form-control','placeholder'=>trans('admin.code')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('logo',trans('admin.logo'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="logo">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
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
