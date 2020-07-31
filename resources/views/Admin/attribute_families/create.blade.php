@extends('Admin.layouts.app', ['activePage' => 'attribute_family-management', 'titlePage' => trans('admin.attribute_families')])
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
                            <a href="{{aurl('/attribute_families')}}" class="btn btn-circle btn-icon-only btn-default" tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                                <i class="fa fa-list"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body form">
                        <div class="col-md-12">
                            @php
                                $ids = [];
                            @endphp
                            {!!
                            Form::open(['url'=>route('attribute_families.store'),'id'=>'users','files'=>true,'class'=>'form-horizontal
                            form-row-seperated']) !!}
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @php
                            array_push($ids,$localeCode);
                            @endphp
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
    <?php foreach($ids as $i) { ?>
    $('.name_{{$i}}').on('keyup', function () {
        $('.slug_{{$i}}').val('/'+$(this).val());
    })
    <?php } ?>
    $('.name_en').on('keyup', function () {
        $('.slug').val($(this).val());
    });

</script>
@endpush
@stop
