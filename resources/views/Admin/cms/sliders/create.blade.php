@extends('Admin.layouts.app', ['activePage' => 'sliders-management', 'titlePage' => trans('admin.sliders')])
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
                    <a href="{{route('sliders.index')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!!
                    Form::open(['url'=>route('sliders.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated','id'=> 'create-event']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('header',trans('admin.header'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('header',old('header'),['class'=>'form-control','placeholder'=>trans('admin.header')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="image" class=" control-label">Main Image</label>
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('link',trans('admin.link'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::url('link',old('link'),['class'=>'form-control','placeholder'=>trans('admin.link')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('body',trans('admin.body'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::textarea('body',old('body'),['class'=>'form-control','placeholder'=>trans('admin.body')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('status',trans('admin.status'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('status',[1 => trans('admin.show'), 0 => trans('admin.hide')],old('status'),['class'=>'form-control','placeholder'=>trans('admin.status')])
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
