@extends('Admin.layouts.app', ['activePage' => 'testimonials-management', 'titlePage' => trans('admin.testimonials')])
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
                    <a href="{{route('testimonials.index')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!!
                    Form::open(['url'=>route('testimonials.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated','id'=> 'create-event']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('name',trans('admin.name'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('name',old('name'),['class'=>'form-control','placeholder'=>trans('admin.name')])
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
                        {!! Form::label('job_title',trans('admin.job_title'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('job_title',old('job_title'),['class'=>'form-control','placeholder'=>trans('admin.job_title')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('project_type',trans('admin.project_type'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('project_type',old('project_type'),['class'=>'form-control','placeholder'=>trans('admin.project_type')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('comment',trans('admin.comment'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('comment',old('comment'),['class'=>'form-control','placeholder'=>trans('admin.comment')])
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
