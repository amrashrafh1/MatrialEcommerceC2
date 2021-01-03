@extends('Admin.layouts.app', ['activePage' => 'category-management', 'titlePage' => trans('admin.categories')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    <div class="col-md-12">
        @if($errors->any())
        @foreach($errors->all() as $error)
        <div class="alert alert-danger"> {{$error}}</div>
        @endforeach
        @endif
        <div class="widget-extra body-req portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/categories/create')}}"
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
                                    'route' => ['categories.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/categories')}}"
                        data-toggle="tooltip" title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="col-md-12">
                    {!! Form::open(['url'=>route('categories.update',
                    $rows->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated','id' => 'edit-category']) !!}
                    <div class="form-group row">
                        <div class="col-md-3">
                            {!! Form::label('parent_id',trans('admin.cat_id'),[' control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            <select id=parent class="custom-select mt-15 @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="0">@lang('admin.select_cat_id')</option>
                                @foreach($categories as $key => $category)
                                        <option value="{{ $key }}" @if ($rows->parent_id == $key) selected @endif> {{ $category }} </option>
                                @endforeach
                            </select>
                            @error('parent_id') {{ $message }} @enderror
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <img class="img-reponsive" src="{{ Storage::url($rows->image) }}">
                    </div>
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
                    <br/>
                    <div class="form-group row">
                        <div class="col-md-3">
                            {!! Form::label('status',trans('admin.status'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::select('status',[1 => 'Show', 0 => 'hidden'],$rows->status,['class'=>'form-control','placeholder'=>trans('admin.select_cat_id')])
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
                                                value="{{old('name_'. $localeCode, $rows->getTranslation('name', $localeCode))}}"
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
                                                placeholder="@lang('user.slug')" required value='{{$rows->slug}}'>
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
                                                id="description_{{$localeCode}}">{!! old('description_'.$localeCode, $rows->getTranslation('description', $localeCode)) !!}</textarea>
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
                                                value="{{old('meta_tag_'.$localeCode, $rows->getTranslation('meta_tag', $localeCode))}}">
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
                                                value="{{old('meta_description_'.$localeCode, $rows->getTranslation('meta_description', $localeCode))}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="meta_keyword_{{$localeCode}}"
                                                class=" control-label">@lang('user.meta_keywords_'.$properties['name'])
                                            </label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="meta_keyword_{{$localeCode}}" value="{{old('meta_keyword_'.$localeCode,$rows->getTranslation('meta_keyword', $localeCode))}}" data-role="tagsinput">
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
@push('js')
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validatorCategoryForm->selector('#edit-category') !!}
    <script>
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
@endsection
