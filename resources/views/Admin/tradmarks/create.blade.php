@extends('Admin.layouts.app', ['activePage' => 'tradmark-management', 'titlePage' => trans('admin.tradmarks')])
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
                    <a href="{{aurl('/tradmarks')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12" id="create-tradmark">

                    {!!
                    Form::open(['url'=>route('tradmarks.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('name',trans('admin.name') .' ('. $properties['native'] . ')',['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <input type="text" @if($localeCode === 'en') @keyup="changeSlug" @endif name="name_{{$localeCode}}" class="form-control"
                                placeholder="Name in {{$properties['name']}}" value="{{old('name_'. $localeCode)}}">
                        </div>
                    </div>
                    <br>
                    @endforeach
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="name" class=" control-label">Slug</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="slug" class="form-control" placeholder="Slug"  v-model="slug">
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('logo',trans('admin.logo'),['class'=>'control-label']) !!}
                            </div>
                            <div class="col-md-10">
                                    <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                            <input type="file" class="custom-file-input" id="customFile" name="logo">
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
@push('js')
<script>
    var vuejs = new Vue({
        el: '#create-tradmark',
        data: {
            slug: '',
        },
        methods: {
            changeSlug({
                target
            }) {
                this.slug = target.value.split(' ').join('-')
            }
        }
    });

</script>
@endpush
@stop
