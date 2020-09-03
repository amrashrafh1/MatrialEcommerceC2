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
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('name',trans('admin.name') .' ('. $properties['name'] . ')',['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('name_'.$localeCode,\App\Category::where('id', $rows->id)->first()->getTranslation('name', $localeCode),['class'=>'form-control name_'.$localeCode,'placeholder'=>trans('admin.name') .' ('. $properties['native'] . ')'])
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
                            Form::text('slug',$rows->slug,['class'=>'form-control slug','placeholder'=>trans('admin.slug')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('category_id',trans('admin.cat_id'),[' control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('category_id',\App\Category::where('id', '!=', $rows->id)->pluck('name','id'),$rows->category_id,['class'=>'form-control','placeholder'=>trans('admin.select_cat_id')])
                            !!}
                        </div>
                    </div>
                    <br>
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
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="description" class=" control-label">@lang('admin.description')
                                {{ $properties['name'] }}</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="description_{{ $localeCode }}" class="form-control"
                                placeholder="description {{ $properties['name'] }}"
                                id="description_{{ $localeCode }}">{!! \App\Category::where('id', $rows->id)->first()->getTranslation('description', $localeCode) !!}</textarea>
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
                            Form::select('status',[1 => 'Show', 0 => 'hidden'],$rows->status,['class'=>'form-control','placeholder'=>trans('admin.select_cat_id')])
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
<script src="https://cdn.ckeditor.com/ckeditor5/15.0.0/classic/ckeditor.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! $validatorCategoryForm->selector('#edit-category') !!}
    <script>
        $('.slug').on('keyup', function () {
            $(this).val($(this).val().replace(' ', '-').toLowerCase());
        });
        <?php foreach(\LaravelLocalization::getSupportedLocales() as $locale => $props) { ?>
            ClassicEditor
                .create( document.querySelector( '#description_{{$locale}}' ) )
                .catch( error => {
                    console.error( error );
                } );
        <?php } ?>
    </script>
    @endpush
@stop
