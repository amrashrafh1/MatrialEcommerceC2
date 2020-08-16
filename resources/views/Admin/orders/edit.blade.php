@extends('Admin.layouts.app', ['activePage' => 'category-management', 'titlePage' => trans('admin.orders')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    <div class="col-md-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{$error}}</div>
        @endforeach
        @endif
        <div class="widget-extra body-req card light bordered">
            <div class="card-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/orders/create')}}"
                        data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.users')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                    <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.users')}}">
                        <a data-toggle="modal" data-target="#myModal{{$rows->id}}"
                            class="btn btn-circle btn-icon-only btn-default" href="">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/orders')}}"
                        data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    {!! Form::open(['url'=>route('orders.update',
                    $rows->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('order_id',trans('admin.order_id'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('order_id',$rows->order_id,['class'=>'form-control order_id','placeholder'=>trans('admin.order_id')])
                            !!}
                        </div>
                    </div>
                    <span class='text-danger'>@lang('admin.if_order_id_changed_will_send_mail')</span>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('status',trans('admin.status'),[' control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                                Form::text('status',$rows->status,['class'=>'form-control status','placeholder'=>trans('admin.status')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        {!! Form::submit(trans('admin.update_and_send'),['class'=>'btn btn-success']) !!}
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
