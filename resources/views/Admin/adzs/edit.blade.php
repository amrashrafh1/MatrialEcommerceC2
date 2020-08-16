@extends('Admin.layouts.app', ['activePage' => 'adzs-management', 'titlePage' => trans('admin.Adz')])
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
                    <a href="{{route('adzs.index')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    {!!
                    Form::open(['url'=>route('adzs.update', $rows->id),'method' => 'PUT','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated','id'=> 'create-event']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('header',trans('admin.header'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('header',old('header', $rows->header),['class'=>'form-control','placeholder'=>trans('admin.header')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <img class=" img-responsive" src="{{Storage::url($rows->image)}}"/>
                        </div>
                        <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="image" class=" control-label">Main Image</label>
                        </div>
                        <div class="col-md-10">
                            <span>@lang('admin.required_=_Height:_503px_&&_width:_465px')</span>
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('link',trans('admin.link'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::url('link',old('link', $rows->link),['class'=>'form-control','placeholder'=>trans('admin.link')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('body',trans('admin.body'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::textarea('body',old('body', $rows->body),['class'=>'form-control','placeholder'=>trans('admin.body')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('start_at',trans('admin.start_at'),['class'=>'
                        control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::dateTime('start_at',$rows->start_at,['class'=>'form-control datetimepicker','placeholder'=>trans('admin.start_at')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('expire_at',trans('admin.expire_at'),['class'=>'
                        control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::dateTime('expire_at',$rows->expire_at,['class'=>'form-control datetimepicker','placeholder'=>trans('admin.expire_at')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                        {!! Form::label('status',trans('admin.status'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('status',[1 => trans('admin.show'), 0 => trans('admin.hide')],old('status', $rows->status),['class'=>'form-control','placeholder'=>trans('admin.status')])
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
            </div>
        </div>
    </div>
</div>

@push('js')
<link href="{{ url('/') }}/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
<script src="{{ url('/') }}/js/bootstrap-material-datetimepicker.js"></script>
<script>
    $('.datetimepicker').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', minDate : new Date() });

</script>
@endpush
@stop
