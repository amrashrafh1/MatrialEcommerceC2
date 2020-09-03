@extends('Admin.layouts.app', ['activePage' => 'product-management', 'titlePage' => trans('admin.event_products')])
@section('content')
<div class="container-fluid pt-8">
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
                    <a href="{{aurl('/cmss')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form" id="element">
                @livewire('cmss.add-products', ['cms'=>$row])
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@stop
