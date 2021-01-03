@extends('Admin.layouts.app', ['activePage' => 'category-management', 'titlePage' => trans('admin.categories')])
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
                    <a href="{{aurl('/categories')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    {!!
                    Form::open(['url'=>route('categories.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated', 'id' =>'create-category']) !!}
                    <div class="form-group row">
                        <div class="col-md-3">
                            {!! Form::label('parent_id',trans('admin.cat_id'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            <select id=category class="custom-select mt-15 @error('parent_id') is-invalid @enderror"
                                name="parent_id">
                                <option value="0">Select a parent category</option>
                                @foreach($categories as $key => $category)
                                ||<option value="{{ $key }}"> {{ $category }} </option>
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="image" class=" control-label">Main Image</label>
                        </div>
                        <div class="col-md-9">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-md-3">
                            {!! Form::label('status',trans('admin.status'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::select('status',[1 => 'Show', 0 =>
                            'hidden'],old('status'),['class'=>'form-control','placeholder'=>trans('admin.status')])
                            !!}
                        </div>
                    </div>
                    <br>
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
                                    @if($localeCode === 'en')
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="name" class=" control-label">@lang('user.slug') <abbr
                                                    title="required" class="required">*</abbr></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="slug" class="form-control slug"
                                                placeholder="@lang('user.slug')" required>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="description"
                                                class=" control-label">@lang('user.Description_in_'.
                                                $properties['name']) @if($localeCode == 'en') <abbr title="required"
                                                    class="required">*</abbr>@endif</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="description_{{$localeCode}}" class="form-control"
                                                placeholder="@lang('user.Description_in_'.
                                                    $properties['name'])"
                                                id="description_{{$localeCode}}">{!! old('description_'.$localeCode) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="meta_tag_{{$localeCode}}"
                                                class=" control-label">@lang('user.meta_tag_'.$properties['name'])
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="meta_tag_{{$localeCode}}" class="form-control mb-4"
                                                placeholder="@lang('user.meta_tag_'.$properties['name'])"
                                                value="{{old('meta_tag_'.$localeCode)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="meta_description_{{$localeCode}}"
                                                class=" control-label">@lang('user.meta_description_'.$properties['name'])
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="meta_description_{{$localeCode}}"
                                                class="form-control mb-4"
                                                placeholder="@lang('user.meta_description_'.$properties['name'])"
                                                value="{{old('meta_description_'.$localeCode)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="meta_keyword_{{$localeCode}}"
                                                class=" control-label">@lang('user.meta_keywords_'.$properties['name'])
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="meta_keyword_{{$localeCode}}"
                                                value="{{old('meta_keyword_'.$localeCode)}}" data-role="tagsinput">
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
@push('js')
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validatorCategoryForm->selector('#create-category') !!}
<script>
    $('.name_en').on('keyup', function () {
        $('.slug').val($(this).val());
    })
    $('.slug').on('keyup', function () {
        $(this).val($(this).val().replace(' ', '-').toLowerCase());
    });
    <?php foreach(\LaravelLocalization::getSupportedLocales() as $locale => $props) { ?>
            CKEDITOR.replace('description_{{$locale}}');
        <?php } ?>
        $('form').keypress(function(e){
      if(e.keyCode==13)
      //$('#linkadd').click();
      e.preventDefault();
    });
</script>
@endpush
@stop
