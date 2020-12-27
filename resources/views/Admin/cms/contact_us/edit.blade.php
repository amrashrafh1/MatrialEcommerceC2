@extends('Admin.layouts.app', ['activePage' => 'contact_us-management', 'titlePage' => trans('admin.countries')])
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
                    <a href="{{route('contact_us.index')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    {!!
                    Form::open(['url'=>route('contact_us.update', $rows->id),'method' => 'PUT','id'=>'users','files'=>true,'class'=>'form-horizontal
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
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('email',trans('admin.email'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::email('email',old('email', $rows->email),['class'=>'form-control','placeholder'=>trans('admin.email')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('mobile',trans('admin.mobile'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('mobile',old('mobile', $rows->mobile),['class'=>'form-control','placeholder'=>trans('admin.mobile')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('subject',trans('admin.subject'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('subject',old('subject', $rows->subject),['class'=>'form-control','placeholder'=>trans('admin.subject')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="message" class=" control-label">@lang('admin.message')</label>
                        </div>
                        <div class="col-md-10">
                            <textarea type="text" name="message" id='message'
                                placeholder="{{trans('admin.message')}}" >{!! $rows->message !!} </textarea>
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
        CKEDITOR.replace('message');

</script>
@endpush
@stop
