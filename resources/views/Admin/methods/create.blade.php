@extends('Admin.layouts.app', ['activePage' => 'methods-management', 'titlePage' => trans('admin.methods')])
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
                            <a href="{{aurl('/methods')}}" class="btn btn-circle btn-icon-only btn-default" tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body form">
                        <div class="row">
                        <div class="col-md-8">
                            {!!
                            Form::open(['url'=>route('methods.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                            form-row-seperated', 'id' =>'create-methods']) !!}
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('name',trans('admin.name'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::text('name',old('name'),['class'=>'form-control name','placeholder'=>trans('admin.name')])
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
                                    Form::select('status',[0 => trans('admin.enable'), 1 => trans('admin.disable')],old('enable'),['class'=>'form-control','placeholder'=>trans('admin.enable')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div id="app">
                            <shipping-type :type="{{json_encode([
                            'flat_rate_per_order' => trans('admin.flat_rate_per_order'),
                            'quantity_based_per_order'=> trans('admin.quantity_based_per_order'),
                            'price_based_per_order'=> trans('admin.price_based_per_order'),
                            'flat_rate_per_item'=> trans('admin.flat_rate_per_item'),
                            'weight_based_per_item'=> trans('admin.weight_based_per_item'),
                            'weight_based_per_order'=> trans('admin.weight_based_per_order'),
                            'price_based_per_item'=> trans('admin.price_based_per_item')
                            ])}}" shipping_type="{{trans('admin.shipping_type')}}" value="{{trans('admin.cost')}}"
                            quantity="{{trans('admin.quantity')}}"></shipping-type>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="value" class=" control-label">@lang('admin.cost') (USD)</label>
                                </div>
                                <div class="col-md-10">
                                    <input name="value" type="number" class="form-control" step="0.00"
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
                                              placeholder="{{trans('admin.display_text')}}"></textarea>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <div class="col-md-2 ">
                                    {!! Form::label('zone_id',trans('admin.zones'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::select('zone_id',\App\Zone::pluck('name','id'),old('zone_id'),['id' => 'zone','class'=>'form-control', 'style'=> 'height:auto','placeholder' => 'Select Zone'])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2 ">
                                    {!! Form::label('company_id',trans('admin.shippingCompanies'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::select('company_id',['Select zone first'],old('company_id'),['class'=>'form-control', 'style'=> 'height:auto','id' => 'company'])
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
    {!! $validator->selector('#create-methods') !!}
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
