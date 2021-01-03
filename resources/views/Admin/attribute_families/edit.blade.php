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
            <div class="card-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/attribute_families/create')}}"
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
                                    'route' => ['attribute_families.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/attribute_families')}}"
                        data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    {!! Form::open(['url'=>route('attribute_families.update',
                    $rows->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal
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
                                                value="{{old('name_'. $localeCode, $rows->getTranslation('name', $localeCode))}}"
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
