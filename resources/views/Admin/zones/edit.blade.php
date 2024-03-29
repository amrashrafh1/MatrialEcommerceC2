@extends('Admin.layouts.app', ['activePage' => 'zones-management', 'titlePage' => trans('admin.zones')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    <div class="col-md-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{$error}}</div>
        @endforeach
        @endif
        <div class="widget-extra body-req portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/zones/create')}}"
                        data-toggle="tooltip" title="{{trans('admin.add')}}  {{trans('admin.users')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                    <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.users')}}">
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
                                    'route' => ['zones.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/zones')}}"
                        data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="col-md-12">
                    {!! Form::open(['url'=>route('zones.update',
                    $rows->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated','id' => 'edit-zones']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('name',trans('admin.name'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('name',$rows->name,['class'=>'form-control name','placeholder'=>trans('admin.name')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row" style="height: 150px;">
                        <div class="col-md-2">
                            {!! Form::label('country_id',trans('admin.country_id'),[' control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('country_id[]',\App\Country::pluck('country_name','id'),$rows->countries,['multiple' => 'multiple','class'=>'form-control','style'=> 'height:auto'])
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
                            Form::select('company_id[]',\App\ShippingCompany::pluck('name','id'),$rows->shippingcompanies,['multiple'=>'multiple','class'=>'form-control', 'style'=> 'height:auto'])
                            !!}
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
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator->selector('#edit-zones') !!}
    @endpush
@stop
