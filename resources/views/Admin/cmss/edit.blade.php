@extends('Admin.layouts.app', ['activePage' => 'country-management', 'titlePage' => trans('admin.countries')])
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
                    <a href="{{route('cmss.index')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!!
                    Form::open(['url'=>route('cmss.update', $rows->id),'method' => 'PUT','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated','id'=> 'create-event']) !!}
                    <div class="form-group row" id="type">
                        <div class="col-md-2">
                            {!! Form::label('type',trans('admin.select_product'),['class'=>'
                        control-label']) !!}
                        </div>
                        <div class="col-md-9">
                                <select name="type" class="form-control" v-model='type'>
                                    <option value="categories">@lang('admin.categories')</option>
                                    <option value="products">@lang('admin.products')</option>
                                </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row" v-show="type == 'categories'">
                        <div class="col-md-2">
                            {!! Form::label('categories',trans('admin.categories'),['class'=>'
                        control-label']) !!}
                        </div>
                        <div class="col-md-9">
                                <select name="categories[]" class="form-control h-100" multiple>
                                    @foreach(\App\Category::get() as $category)
                                    <option value="{{$category->id}}" @if($rows->type == 'categories') @if($rows->categories->pluck('id')->contains($category->id)) selected @endif @endif>{{$category->name}}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                    <br>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('menuTitle',trans('admin.menuTitle') .' ('. $properties['native'] .
                            ')',['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('menuTitle_'.$localeCode,(!empty($rows->menuTitle))?$rows->getTranslation('menuTitle', $localeCode):'',['class'=>'form-control
                            menuTitle_'.$localeCode,'placeholder'=>trans('admin.menuTitle') .' ('. $properties['native']
                            .
                            ')'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('title',trans('admin.title') .' ('. $properties['native'] .
                            ')',['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('title_'.$localeCode,(!empty($rows->title))?$rows->getTranslation('title', $localeCode):'',['class'=>'form-control
                            title_'.$localeCode,'placeholder'=>trans('admin.title') .' ('. $properties['native'] .
                            ')'])
                            !!}
                        </div>
                    </div>
                    <br>
                    @endforeach
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('start_at',trans('admin.start_at'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::dateTime('start_at',$rows->start_at,['class'=>'form-control
                            datetimepicker','placeholder'=>trans('admin.start_at')])
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
                            Form::dateTime('expire_at',$rows->expire_at,['class'=>'form-control
                            datetimepicker','placeholder'=>trans('admin.expire_at')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('slug',trans('admin.slug'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('slug',$rows->slug,['class'=>'form-control
                            slug','placeholder'=>trans('admin.slug')])
                            !!}
                        </div>
                    </div>
                    <br>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('content_'.$localeCode,trans('admin.content')  .' ('. $properties['native'] .
                                ')',['class'=>'control-label']) !!}
                            </div>
                            <div class="col-md-9">
                                {!!
                                Form::textarea('content_'.$localeCode,(!empty($rows->content))?$rows->getTranslation('content', $localeCode):'',['class'=>'form-control','placeholder'=>trans('admin.content') .' ('. $properties['native'] .
                            ')'])
                                !!}
                            </div>
                        </div>
                        <br>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="meta_tag_{{$localeCode}}" class=" control-label">@lang('admin.meta_tag')
                                {{$properties['name']}}</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="meta_tag_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('admin.meta_tag')" value="{{(!empty($rows->meta_tag))?$rows->getTranslation('meta_tag', $localeCode):''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="meta_description_{{$localeCode}}"
                                class=" control-label">@lang('admin.meta_description')
                                {{$properties['name']}}</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="meta_description_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('admin.meta_description')"
                                value="{{(!empty($rows->meta_description))?$rows->getTranslation('meta_description', $localeCode):''}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="keywords_{{$localeCode}}" class=" control-label">@lang('admin.meta_keywords')
                                {{$properties['name']}}</label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" name="meta_keyword_{{$localeCode}}" value="{{(!empty($rows->meta_keyword))?$rows->getTranslation('meta_keyword', $localeCode):''}}" data-role="tagsinput">
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <img class="img-reponsive" src="{{ Storage::url($rows->image) }}">
                    </div>
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
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<link href="{{ url('/') }}/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
@push('js')
<script src="{{ url('/') }}/js/bootstrap-material-datetimepicker.js"></script>
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script>
    var vuejs = new Vue({
        el: '#create-event',
        data: {
            type: '{{$rows->type}}',
        }
    });
</script>
<script>
    $('.slug').on('keyup', function () {
        $(this).val($(this).val().replace(' ', '-').toLowerCase());
    });
    $('form').keypress(function(e){
      if(e.keyCode == 13)
      //$('#linkadd').click();
      e.preventDefault();
    });
    $('.datetimepicker').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', minDate : new Date() });
</script>
@endpush
@stop
