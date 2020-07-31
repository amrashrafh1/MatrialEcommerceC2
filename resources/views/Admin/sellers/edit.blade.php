@extends('Admin.layouts.app', ['activePage' => 'seller-management', 'titlePage' => trans('admin.sellers')])
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
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/seller/create')}}"
                        data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.sellers')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                    <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.sellers')}}">
                        <a data-toggle="modal" data-target="#myModal{{$rows->id}}"
                            class="btn btn-circle btn-icon-only btn-default" href="">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                    <div class="modal fade" id="myModal{{$rows->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">x</button>
                                    <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                </div>
                                <div class="modal-body">
                                    <i class="fa fa-exclamation-triangle"></i> {{trans('admin.ask_del')}}
                                    {{trans('admin.id')}} ({{$rows->id}}) ؟
                                </div>
                                <div class="modal-footer">
                                    {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['seller.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/seller')}}" data-toggle="tooltip"
                        title="{{trans('admin.show_all')}}   {{trans('admin.sellers')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!! Form::open(['url'=>route('seller.update',
                    $rows->id),'method'=>'put','id'=>'sellers','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('name',trans('admin.name'),['class'=>' control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!! Form::text('name', $rows->name
                            ,['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('last_name',trans('admin.last_name'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('last_name',$rows->last_name,['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('email',trans('admin.email'),['class'=>' control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!! Form::email('email', $rows->email
                            ,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('password',trans('admin.password'),['class'=>' control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('password_confirmation',trans('admin.password_confirmation'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::password('password_confirmation',['class'=>'form-control','placeholder'=>trans('admin.password')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('phone',trans('admin.phone'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('phone',$rows->phone,['class'=>'form-control', 'placeholder' => '+1 (769)
                            458-7246'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('address',trans('admin.address'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('address',$rows->address,['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <img class=" img-responsive" src="{{Storage::url($rows->image)}}" />
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('image',trans('admin.image'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
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
                                            {!! Form::submit(trans('admin.save'),['class'=>'btn btn-success']) !!}
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
    @php
    $trans = trans('admin.Admin_will_has_all_permession')
    @endphp
    @stop
