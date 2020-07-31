@extends('Admin.layouts.app', ['activePage' => 'shippingcompanies-management', 'titlePage' => trans('admin.shippingCompanies')])
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
                    <a href="{{aurl('/shippingcompanies')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!! Form::open(['url'=>route('shippingcompanies.update',$rows->id),'method' => 'patch','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                     @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('name',trans('admin.name') .' ('. $properties['native'] .
                                ')',['class'=>'control-label']) !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('name_'.$localeCode,\App\ShippingCompany::where('id', $rows->id)->first()->getTranslation('name', $localeCode),['class'=>'form-control
                                name_'.$localeCode,'placeholder'=>trans('admin.name') .' ('. $properties['native'] .
                                ')'])
                                !!}
                            </div>
                        </div>
                        <br>
                        @endforeach
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('email',trans('admin.email'),['class'=>' control-label']) !!}
                            </div>
                            <div class="col-md-9">
                                {!!
                                Form::text('email',$rows->email,['class'=>'form-control','placeholder'=>trans('admin.email')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('facebook',trans('admin.facebook'),['class'=>' control-label']) !!}
                            </div>
                            <div class="col-md-9">
                                {!!
                                Form::text('facebook',$rows->facebook,['class'=>'form-control','placeholder'=>trans('admin.facebook')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('twitter',trans('admin.twitter'),['class'=>' control-label']) !!}
                            </div>
                            <div class="col-md-9">
                                {!!
                                Form::text('twitter',$rows->twitter,['class'=>'form-control','placeholder'=>trans('admin.twitter')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('website',trans('admin.website_url'),['class'=>' control-label']) !!}
                            </div>
                            <div class="col-md-9">
                                {!!
                                Form::text('website',$rows->website,['class'=>'form-control','placeholder'=>trans('admin.website')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('contact_name',trans('admin.contact_name'),['class'=>' control-label'])
                                !!}
                            </div>
                            <div class="col-md-9">
                                {!!
                                Form::text('contact_name',$rows->contact_name,['class'=>'form-control','placeholder'=>trans('admin.contact_name')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('mobile',trans('admin.mobile'),['class'=>' control-label']) !!}
                            </div>
                            <div class="col-md-9">
                                {!!
                                Form::text('mobile',$rows->mobile,['class'=>'form-control','placeholder'=>'+1 (769) 458-7246'])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('address',trans('admin.address'),['class'=>' control-label']) !!}
                            </div>
                            <div class="col-md-9">
                            {!! Form::text('address',$rows->address,['class'=>'form-control','id' =>
                            'us1-address','placeholder'=>trans('admin.address')])
                            !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('country_id',trans('admin.country'),['class'=>'
                                control-label']) !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::select('country_id',\App\Country::pluck('country_name',
                                'id'),$rows->country_id,['class'=>'form-control','placeholder'=>trans('admin.Country')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group" >
                            @if(empty($rows->icon))
                            <h3>No icon Yet</h3>
                            @else
                                <img class=" img-responsive" src="{{\Storage::url($rows->icon)}}" style="width:500px;">
                            @endif
                    </div>
                        <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('icon',trans('admin.icon'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                        <input type="file" class="custom-file-input" id="customFile" name="icon">
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
@stop
