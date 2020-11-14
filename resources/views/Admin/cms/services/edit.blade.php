@extends('Admin.layouts.app', ['activePage' => 'services-management', 'titlePage' => trans('admin.countries')])
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
                    <a href="{{route('services.index')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    {!!
                    Form::open(['url'=>route('services.update', $rows->id),'method' => 'PUT','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated','id'=> 'create-event']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('name',trans('admin.name'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('name',old('name', $rows->name),['class'=>'form-control','placeholder'=>trans('admin.name')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <img class=" img-responsive" src="{{Storage::url($rows->image)}}" style="height:300px;"/>
                        </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="image" class=" control-label">Main Image</label>
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="description" class=" control-label">@lang('admin.description')</label>
                        </div>
                        <div class="col-md-10">
                            <textarea type="text" name="description" id='description'
                        placeholder="{{trans('admin.description')}}" >{!! $rows->description !!}</textarea>
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
@push('js')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace('description');

</script>
@endpush
@stop
