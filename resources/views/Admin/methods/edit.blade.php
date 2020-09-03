@extends('Admin.layouts.app', ['activePage' => 'methods-management', 'titlePage' => trans('admin.methods')])
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
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/methods/create')}}"
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
                                    'route' => ['methods.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/methods')}}"
                        data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="row">
                <div class="col-md-8">
                    {!!
                    Form::open(['url'=>route('methods.update', $rows->id),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated', 'id' =>'create-methods', 'method' => 'patch']) !!}
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
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('enable',trans('admin.enable'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('status',[0 => trans('admin.enable'), 1 => trans('admin.disable')],old('status',$rows->status),['class'=>'form-control','placeholder'=>trans('admin.enable')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div id="app">
                    <shipping-edit :type="{{json_encode([
                    'flat_rate_per_order'      => trans('admin.flat_rate_per_order'),
                    'quantity_based_per_order' => trans('admin.quantity_based_per_order'),
                    'price_based_per_order'    => trans('admin.price_based_per_order'),
                    'flat_rate_per_item'       => trans('admin.flat_rate_per_item'),
                    'weight_based_per_item'    => trans('admin.weight_based_per_item'),
                    'weight_based_per_order'   => trans('admin.weight_based_per_order'),
                    'price_based_per_item'     => trans('admin.price_based_per_item')
                    ])}}" shipping_type="{{trans('admin.shipping_type')}}" value="{{trans('admin.cost')}}"
                    quantity="{{trans('admin.quantity')}}"
                     rule='{{$rows->rule}}'
                     weight='{{$rows->weight}}'></shipping-edit>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="value" class=" control-label">@lang('admin.cost') (USD)</label>
                        </div>
                        <div class="col-md-10">
                        <input name="value" type="number" class="form-control" step="0.00" value="{{$rows->value}}"
                                   placeholder="{{trans('admin.cost')}}">
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="display_text" class=" control-label">@lang('admin.display_text')</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="display_text" type="text" class="form-control"
                        placeholder="{{trans('admin.display_text')}}">{{$rows->display_text}}</textarea>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2 ">
                            {!! Form::label('zone_id',trans('admin.zones'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('zone_id',\App\Zone::pluck('name','id'),$rows->zone_id,['id' => 'zone','class'=>'form-control', 'style'=> 'height:auto','placeholder' => 'Select Zone'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2 ">
                            {!! Form::label('company_id',trans('admin.shippingCompanies'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            @php
                            $zone = \App\Zone::find($rows->zone_id);
                            @endphp
                            {!!
                            Form::select('company_id',\App\ShippingCompany::whereIn('id',$zone->shippingcompanies->pluck('id'))->pluck('name','id'),$rows->company_id,['class'=>'form-control', 'style'=> 'height:auto','id' => 'company'])
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
                    <div class="col-md-4">
                        <div class="alert-info p-3" style="color:#31708f;">
                            <span>Quick help:</span>
                            <ul>
                                <li class="p-1">Flat Rate Per Item: Each item's rate will not depend on its weight.</li>
                                <li class="p-1">Weight-Based Per Item: Each item's rate will depend on its weight.</li>
                                <li class="p-1">Weight-Based Per Order: The weight of all the items will be summed, and a rate will be applied to the order based on that sum weight.</li>
                                <li class="p-1">Price based per item: Each item's rate will depend on its price.</li>
                                <li class="p-1">Quantity-Based Per Order: The order's shipping cost will depend on the quantity of shippable items in the order. When setting rates.</li>
                                <li class="p-1">Price-Based Per Order: The order's shipping cost will depend on the total price of the order. When setting rates.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validator->selector('#edit-methods') !!}
    <script>
        $('#zone').on('change', function () {

            axios.post('{{url(\LaravelLocalization::setLocale().'/admin/get/companies/zone/')}}'+ '/'+$(this).val(), {
                _token: '{{csrf_token()}}'
            })
                .then(function (res) {
                    $('#company').children().remove();
                    for($i = 0; $i <= res.data.length; $i++) {
                        $('#company').append(`<option value="${res.data[$i]['id']}">${res.data[$i]['name']['{{\LaravelLocalization::setLocale()}}']}</option>`);
                    }
                })
        });
    </script>
    @endpush
@stop
