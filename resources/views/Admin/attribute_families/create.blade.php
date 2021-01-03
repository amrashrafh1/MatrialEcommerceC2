@extends('Admin.layouts.app', ['activePage' => 'attribute_family-management', 'titlePage' => trans('admin.attribute_families')])
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
                            <a href="{{aurl('/attribute_families')}}" class="btn btn-circle btn-icon-only btn-default" tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body form">
                        <div class="col-md-12">
                            @php
                                $ids = [];
                            @endphp
                            {!!
                            Form::open(['url'=>route('attribute_families.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                            form-row-seperated']) !!}
                            <div class="card card-nav-tabs card-plain">
                                <div class="card-header card-header-info">
                                    <div class="nav-tabs-wrapper">
                                        <ul class="nav nav-tabs" data-tabs="tabs">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <li class="nav-item">
                                                <a class="nav-link @if($localeCode == 'en') active show @endif"
                                                    href="#{{$localeCode}}" data-toggle="tab">{{$localeCode}}</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content text-center">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <div class="tab-pane @if($localeCode == 'en') active show @endif" id="{{$localeCode}}">
                                            <div class="form-group row {{($localeCode === 'en') ? 'required':''}}">
                                                <div class="col-md-3">
                                                    <label for="name"
                                                        class=" control-label">@lang('user.Name_in_'.$properties['name'])
                                                        @if($localeCode == 'en') <abbr title="required"
                                                            class="required">*</abbr>@endif</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input type="text" name="name_{{$localeCode}}"
                                                        class="form-control name_{{$localeCode}}"
                                                        placeholder="@lang('user.Name_in_'.$properties['name'])"
                                                        value="{{old('name_'. $localeCode)}}"
                                                        {{($localeCode === 'en') ? 'required':''}}>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
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
