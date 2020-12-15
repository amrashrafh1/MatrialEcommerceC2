@extends('Admin.layouts.app', ['activePage' => 'stores-management', 'titlePage' => trans('admin.create')])
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
                <div class="actions">
                    <a href="{{route('seller.stores.store', $seller->id)}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!! Form::open(['url'=>route('seller.stores.store', $seller->id),'id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('seller',trans('admin.seller_email'),['control-label'])
                                !!}
                                <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::email('seller',old('seller', $seller->email),['class'=>'form-control
                                required','placeholder'=>trans('admin.seller_email')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('name',trans('user.store_name'),['control-label'])
                                !!}
                                <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('name',old('name'),['class'=>'form-control
                                required','placeholder'=>trans('user.store_name')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('email',trans('user.email'),['control-label'])
                                !!}
                                <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::email('email',old('email'),['class'=>'form-control','placeholder'=>trans('user.email')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('country_id',trans('user.country'),['control-label'])
                                !!}
                                <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::select('country_id',\App\Country::whereIn('id',
                                \App\Setting::latest('id')->first()->seller_countries()->pluck('country_id'))->pluck('country_name','id'),['class'=>'form-control','placeholder'=>trans('user.country')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('city',trans('user.city'),['control-label'])
                                !!} <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('city',old('city'),['class'=>'form-control','placeholder'=>trans('user.city')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('state',trans('user.state'),['control-label'])
                                !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('state',old('state'),['class'=>'form-control','placeholder'=>trans('user.state')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('image',trans('admin.image'),['class'=>'control-label']) !!}
                                <abbr title="required" class="required">*</abbr>
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
                                {!!
                                Form::label('type',trans('user.type'),['control-label'])
                                !!} <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::select('type',[0 =>
                                trans('user.individual'), 1
                                =>trans('user.business')],old('business'),['class'=>'form-control','placeholder'=>trans('user.business')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('business',trans('user.business'),['control-label'])
                                !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('business',old('business'),['class'=>'form-control','placeholder'=>trans('user.business')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('address1',trans('user.address1'),['control-label'])
                                !!} <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('address1',old('address1'),['class'=>'form-control','placeholder'=>trans('user.business')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('address2',trans('user.address2'),['control-label'])
                                !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('address2',old('address2'),['class'=>'form-control','placeholder'=>trans('user.address2')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('address3',trans('user.address3'),['control-label'])
                                !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('address3',old('address3'),['class'=>'form-control','placeholder'=>trans('user.address3')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('phone1',trans('user.phone1'),['control-label'])
                                !!} <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('phone1',old('phone1'),['class'=>'form-control','placeholder'=>trans('user.phone1')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('phone2',trans('user.phone2'),['control-label'])
                                !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('phone2',old('phone2'),['class'=>'form-control','placeholder'=>trans('user.phone2')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!! Form::label('phone3',trans('user.phone3'),['control-label'])
                                !!}
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::text('phone3',old('phone3'),['class'=>'form-control','placeholder'=>trans('user.phone3')])
                                !!}
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <div class="col-md-2">
                                {!!
                                Form::label('description',trans('user.about_store'),['control-label'])
                                !!} <abbr title="required" class="required">*</abbr>
                            </div>
                            <div class="col-md-10">
                                {!!
                                Form::textarea('description',old('description'),['class'=>'form-control','placeholder'=>trans('user.about_store')])
                                !!}
                            </div>
                        </div>
                        <br />
                    </div>
                    <div id="per"></div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-10">
                                        {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
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
@php
    $trans = trans('admin.Admin_will_has_all_permession')
@endphp
@push('js')
    <script>
        $trans = "<?php echo $trans ?>";
        if ($('#select3').val() == 'administrator') {
            $('#permission').fadeIn();
        } else {
            $('#permission').hide();
        }
        $('#select3').on('change', function () {
            if ($(this).val() == 'administrator') {
                $('#permission').fadeIn();
                $('.alert-info').hide();
            } else {
                if ($('#select3').val() == 'superadministrator') {
                    $('#per').append('<div class="alert alert-info">'+ $trans +'</div>');
                    $('#permission').hide();
                } else {
                    $('.alert-info').hide();
                    $('#permission').hide();
                }
            }
        });
        if ($('#select3').val() == 'superadministrator') {
            $('#per').append('<div class="alert alert-info">'+ $trans +'</div>');
        }

    </script>
@endpush
@stop
