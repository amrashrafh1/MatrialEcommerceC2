@extends('Admin.layouts.app', ['activePage' => 'attribute_family-management', 'titlePage' =>
trans('admin.attribute_families')])
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
                <div class="table-responsive">
                    {!! Form::open([
                    "method" => "post",
                    "url" => [route('attribute_families_destroy_all')],
                    'id' => 'form_data'
                    ]) !!}
                    {!! $dataTable->table(["class"=> "table table-striped table-bordered table-hover table-checkable
                    dataTable no-footer"],true) !!}
                    <div class="clearfix"></div>
                </div>
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

@foreach(\App\Attribute_Family::get() as $attr)
<div class="modal fade @if($loop->last) last_modal @endif" id="family_modal{{$attr->id}}" tabindex="-1" role="dialog"
    aria-labelledby="family_modal{{$attr->id}}Label" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="family_modal{{$attr->id}}Label">
                    @lang('admin.if_your_delete_any_attribute_will_deleted_from_all_product_too')</h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
            </div>
            <div class="modal-body" id='{{$attr->id}}'>
                @livewire('admin.attribute.attribute', $attr)
            </div>
        </div>
    </div>
</div>
@endforeach
</div>

@push('js')
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script>
    delete_all();

    function myFunction(e) {
        e.preventDefault();
    }
    /* $('form').keypress(function (e) {
        if (e.keyCode == 13)
            //$('#linkadd').click();
            e.preventDefault();
    }); */


</script>
{!! $dataTable->scripts() !!}
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
