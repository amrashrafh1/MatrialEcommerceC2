@extends('Admin.layouts.app', ['activePage' => 'attribute_family-management', 'titlePage' =>
trans('admin.attributes')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    {{-- @include('sweetalert::alert') --}}

    <div class="col-md-12">
        <div class="card light bordered">
            <div class="card-header">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
            </div>
            <div class="card-body">
                @livewire('admin.attribute.attribute', ['attr' => $family])
            </div>
        </div>
    </div>
    <div class="modal fade" id="mutlipleDelete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal">x</button>
                    <h4 class="modal-title">{{trans("admin.delete")}} </h4>
                </div>
                <div class="modal-body">
                    <div class="delete_done"><i class="fa fa-exclamation-triangle"></i> {{trans("admin.ask-delete")}}
                        <span id="count"></span> {{trans("admin.record")}} ! </div>
                    <div class="check_delete">{{trans("admin.check-delete")}}</div>
                </div>
                <div class="modal-footer">
                    {!! Form::submit(trans("admin.approval"), ["class" => "btn btn-danger del_all"]) !!}
                    <a class="btn btn-default" data-dismiss="modal">{{trans("admin.cancel")}}</a>
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
@endpush
{!! Form::close() !!}
<style>
    .tags {
        list-style: none;
        margin: 0;
        overflow: hidden;
        padding: 0;
    }

    .tags li {
        float: left;
    }

    .tag {
        background: #eee;
        border-radius: 3px 0 0 3px;
        color: #999;
        display: inline-block;
        height: 26px;
        line-height: 26px;
        padding: 0 20px 0 23px;
        position: relative;
        margin: 0 10px 10px 0;
        text-decoration: none;
        -webkit-transition: color 0.2s;
    }

    .tag::before {
        background: #fff;
        border-radius: 10px;
        box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
        content: '';
        height: 6px;
        left: 10px;
        position: absolute;
        width: 6px;
        top: 10px;
    }

    .tag::after {
        background: #fff;
        border-bottom: 13px solid transparent;
        border-left: 10px solid #eee;
        border-top: 13px solid transparent;
        content: '';
        position: absolute;
        right: 0;
        top: 0;
    }

    .tag:hover {
        background-color: #0063D1;
        color: white;
    }

    .tag:hover::after {
        border-left-color: #0063D1;
    }

</style>
@stop
