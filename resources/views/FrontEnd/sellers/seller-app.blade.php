@extends('layouts.app')
@section('content')

<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>{{auth()->user()->name}} @lang('user.dashboard')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area" style="flex: 0 0 100%;
            max-width: 100%;
            order: 2;">
                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="alert alert-danger"> {{$error}}</div>
                @endforeach
                @endif
                @include('sweetalert::alert')

                <div class="tab-content mt-5">
                    <!-- .tab-pane -->
                    <div id="grid-extended" class="tab-pane active" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card m-b-20">
                                    <div class="card-header">
                                        <h2 class="mb-0"> @lang('user.store_application')</h2>
                                    </div>
                                    <div class="card-body">
                                        {!!
                                        Form::open(['url'=> route('store_app'), 'id' => 'seller-app', 'method' =>
                                        'post','enctype'=> "multipart/form-data"])
                                        !!}
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
                                        <div class="form-group">
                                            <input value="@lang('user.submit')" type="submit" class="btn btn-success" />
                                        </div>
                                        <br>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .dropzone .dz-preview .dz-image {
  width: 250px;
  height: 250px;
}


Dropzone.options.myAwesomeDropzone = {
  ....
  thumbnailWidth: 250,
  thumbnailHeight: 250,
  ....
}
</style>
@push('js')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! $SellerApp->selector('#seller-app') !!}
@endpush
@endsection
