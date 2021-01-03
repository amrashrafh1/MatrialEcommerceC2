@extends('Admin.layouts.app', ['activePage' => 'post-management', 'titlePage' => trans('admin.posts')])
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
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/posts/create')}}"
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
                                    'route' => ['posts.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/posts')}}" data-toggle="tooltip"
                        title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!! Form::open(['url'=>route('posts.update',
                    $rows->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <div class="card card-nav-tabs card-plain">
                        <div class="card-header card-header-info">
                            <div class="nav-tabs-wrapper">
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    @php
                                    $ids = [];
                                    @endphp
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @php
                                        array_push($ids,$localeCode);
                                    @endphp
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
                                            <label for="title"
                                                class=" control-label">@lang('user.title_in_'.$properties['name'])
                                                @if($localeCode == 'en') <abbr title="required"
                                                    class="required">*</abbr>@endif</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="title_{{$localeCode}}"
                                                class="form-control title_{{$localeCode}}"
                                                placeholder="@lang('user.title_in_'.$properties['name'])"
                                                value="{{old('title_'. $localeCode, $rows->getTranslation('title', $localeCode))}}"
                                                {{($localeCode === 'en') ? 'required':''}}>
                                        </div>
                                    </div>
                                    @if($localeCode === 'en')
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="name" class=" control-label slug">@lang('user.slug') <abbr
                                                    title="required" class="required" >*</abbr></label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" name="slug" class="form-control slug"
                                                placeholder="@lang('user.slug')" value='{{old('slug')}}' required>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="content"
                                                class=" control-label">@lang('user.content_in_'.
                                                $properties['name']) @if($localeCode == 'en') <abbr title="required"
                                                    class="required">*</abbr>@endif</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="content_{{$localeCode}}" class="form-control"
                                                placeholder="@lang('user.content_in_'.
                                                    $properties['name'])"
                                                id="content_{{$localeCode}}">{!! old('content_'.$localeCode, $rows->getTranslation('content', $localeCode)) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-3">
                                            <label for="description" class=" control-label">@lang('user.Tags_in_'.
                                                $properties['name'])</label>
                                        </div>
                                        @php
                                        $tags = [];
                                        foreach($rows->tags()->select('name')->get() as $tag) {
                                        $value = $tag->translate('name', $localeCode);
                                        array_push($tags, $value);
                                        }
                                        @endphp
                                        <div class="col-md-9">
                                            <input type="text" name="tags_{{$localeCode}}" placeholder="@lang('user.Tags_in_'.
                                            $properties['name'])"
                                                value='{{(!empty($rows->tags))?implode(',', $tags):''}}' data-role="tagsinput">
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
                                            <input type="text" name="meta_keyword_{{$localeCode}}"
                                                value="{{old('meta_keyword_'.$localeCode, $rows->getTranslation('meta_keyword', $localeCode))}}" data-role="tagsinput">
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('slug',trans('admin.slug'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('slug',\App\Post::where('id', $rows->id)->first()->slug,['class'=>'form-control
                            slug','placeholder'=>trans('admin.slug')])
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
                            {!! Form::label('image',trans('admin.image'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('publish_at',trans('admin.publish_at'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!! Form::text('publish_at',$rows->publish_at,['class'=>'form-control datetimepicker']) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('comment',trans('admin.comment'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="commentable" id="toggle-one" {{($rows->commentable == 1)?'checked':''}} data-toggle="toggle">
                              </label>
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
<script src="//cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
@push('js')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script>
        <?php foreach($ids as $i) { ?>
        CKEDITOR.replace('editor_{{$i}}');
       <?php }?>
       $(function() {
            $('#toggle-one').bootstrapToggle();
        });
        $('.slug').on('keyup', function () {
            $(this).val($(this).val().replace(' ', '-').toLowerCase());
        });
        $('.datetimepicker').datetimepicker({
            icons: {
                time    : "fa fa-clock-o",
                date    : "fa fa-calendar",
                up      : "fa fa-chevron-up",
                down    : "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next    : 'fa fa-chevron-right',
                today   : 'fa fa-screenshot',
                clear   : 'fa fa-trash',
                close   : 'fa fa-remove'
            },
            format:'DD-MM-YYYY HH:mm',
        });
        $('form').keypress(function(e){
      if(e.keyCode==13)
      //$('#linkadd').click();
      e.preventDefault();
    });
</script>
@endpush
@stop
