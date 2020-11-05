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
                            <a href="{{aurl('/categories')}}" class="btn btn-circle btn-icon-only btn-default" tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body form">
                        <div class="col-md-12">
                            {!!
                            Form::open(['url'=>route('categories.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                            form-row-seperated', 'id' =>'create-category']) !!}
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('name',trans('admin.name') .' ('. $properties['native'] . ')',['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::text('name_'.$localeCode,old('name'),['class'=>'form-control name_'.$localeCode,'placeholder'=>trans('admin.name') .' ('. $properties['native'] . ')'])
                                    !!}
                                </div>
                            </div>
                            <br>
                            @endforeach
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('slug',trans('admin.slug'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::text('slug',old('slug'),['class'=>'form-control slug','placeholder'=>trans('admin.slug')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('category_id',trans('admin.cat_id'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::select('category_id',\App\Category::pluck('name','id'),old('category_id'),['class'=>'form-control','placeholder'=>trans('admin.select_cat_id')])
                                    !!}
                                </div>
                            </div>
                            <br>
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
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <div class="form-group row">
                                <div class="col-md-2">
                                    <label for="description" class=" control-label">@lang('admin.description')
                                        {{ $properties['name'] }}</label>
                                </div>
                                <div class="col-md-10">
                                    <textarea name="description_{{ $localeCode }}" class="form-control"
                                        placeholder="description {{ $properties['name'] }}"
                                        id="description_{{ $localeCode }}"></textarea>
                                </div>
                            </div>
                            @endforeach
                            <br/>
                            <div class="form-group row">
                                <div class="col-md-2">
                                    {!! Form::label('status',trans('admin.status'),['class'=>'control-label']) !!}
                                </div>
                                <div class="col-md-10">
                                    {!!
                                    Form::select('status',[1 => 'Show', 0 => 'hidden'],old('status'),['class'=>'form-control','placeholder'=>trans('admin.status')])
                                    !!}
                                </div>
                            </div>
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="meta_tag_{{$localeCode}}"
                                class=" control-label">@lang('admin.meta_tag_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="meta_tag_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('admin.meta_tag_'.$properties['name'])"
                                value="{{old('meta_tag_'.$localeCode)}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="meta_description_{{$localeCode}}"
                                class=" control-label">@lang('admin.meta_description_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="meta_description_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('admin.meta_description_'.$properties['name'])"
                                value="{{old('meta_description_'.$localeCode)}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="keywords_{{$localeCode}}"
                                class=" control-label">@lang('admin.meta_keywords_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-10">
                        <input type="text" name="meta_keyword_{{$localeCode}}" value="{{old('meta_keyword_'.$localeCode)}}" data-role="tagsinput">
                        </div>
                    </div>
                    @endforeach
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
