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
            <div class="card-header">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a href="{{aurl('/posts')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!!
                    Form::open(['url'=>route('posts.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('title',trans('admin.title') .' ('. $properties['native'] . ')',['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('title_'.$localeCode,old('title_'.$localeCode),['class'=>'form-control title_'.$localeCode,'placeholder'=>trans('admin.title') .' ('. $properties['native'] . ')'])
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
                    @php
                        $ids = [];
                    @endphp
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @php
                        array_push($ids,$localeCode);
                    @endphp
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('content',trans('admin.content') .' ('. $properties['native'] . ')',['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::textarea('content_'.$localeCode,old('content_'.$localeCode),['class'=>'form-control','id' =>
                            'editor_'.$localeCode])
                            !!}
                        </div>
                    </div>
                    <br>
                    @endforeach

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
                              {!!  Form::text('publish_at',old('publish_at'),['class'=>'form-control datetimepicker']) !!}
                           </div>
                        </div>
                    <br>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="tags" class=" control-label">@lang('admin.Tags_in_'.$properties['name'])</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="tags_{{$localeCode}}"
                                placeholder="Tags in {{$properties['name']}}" data-role="tagsinput">
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('comment',trans('admin.comment'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="commentable" id="toggle-one"  data-toggle="toggle">
                            </label>
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

<script src="//cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
@push('js')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script>
    <?php foreach($ids as $i) { ?>
        CKEDITOR.replace('editor_{{$i}}');
    <?php } ?>
    $('.title_en').on('keyup', function () {
        $('.slug').val($(this).val());
    });
    $('.slug').on('keyup', function () {
        $(this).val($(this).val().replace(' ', '-').toLowerCase());
    });
    $('.datetimepicker').datetimepicker({
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        up: "fa fa-chevron-up",
        down: "fa fa-chevron-down",
        previous: 'fa fa-chevron-left',
        next: 'fa fa-chevron-right',
        today: 'fa fa-screenshot',
        clear: 'fa fa-trash',
        close: 'fa fa-remove'
    },
    format:'DD-MM-YYYY HH:mm',
});
    $(function() {
        $('#toggle-one').bootstrapToggle();
    });
    $('form').keypress(function(e){
      if(e.keyCode==13)
      //$('#linkadd').click();
      e.preventDefault();
    });
</script>
@endpush
@stop
