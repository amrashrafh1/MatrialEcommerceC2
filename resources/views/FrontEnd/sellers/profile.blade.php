@extends('layouts.app')
@section('content')

<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>{{$store->name}} @lang('user.prfile')
            </nav>
            @if($errors->any())
            @foreach($errors->all() as $error)
            <div class="alert alert-danger"> {{$error}}</div>
            @endforeach
            @endif
            @include('sweetalert::alert')

            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area" style="flex: 0 0 100%;
            max-width: 100%;
            order: 2;">
                <main id="main" class="site-main">
                    <div class="shop-archive-header" wire:ignore>
                        <div class="jumbotron">
                            <div class="jumbotron-img">
                                <img style='background-size:cover;' alt="" src="{{Storage::url($store->image)}}"
                                    class="jumbo-image alignright">
                            </div>
                            <div class="jumbotron-caption">
                                <h3 class="jumbo-title">{{$store->name}}</h3>
                                <p class="jumbo-subtitle">

                                </p>
                            </div>
                            <!-- .jumbotron-caption -->
                        </div>
                        <!-- .jumbotron -->
                    </div>
                </main>
                <div class="">
                    <!-- .handheld-sidebar-toggle -->
                    <h1 class="woocommerce-products-header__title page-title">@lang('user.dashboard')</h1>
                    @include('FrontEnd.sellers.navs', ['slug' => $store->slug])
                    <!-- .shop-view-switcher -->
                    <!-- .techmarket-advanced-pagination -->
                </div>
                @php
                    $user_id = $store->id;
                @endphp
                <div class="tab-content mt-5">
                    <!-- .tab-pane -->
                    <div id="grid-extended" class="tab-pane active" role="tabpanel">
                        <div class="card-body">
                            {!!
                            Form::open(['url'=> route('store_profile_update', $store->id), 'id' => 'seller-app', 'method' =>
                            'put','enctype'=> "multipart/form-data"])
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
                                    Form::text('name',old('name', $store->name),['class'=>'form-control
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
                                    Form::email('email',old('email',$store->email),['class'=>'form-control','placeholder'=>trans('user.email')])
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
                                    $setting->seller_countries->pluck('country_id'))->pluck('country_name','id'), $store->country->id,['class'=>'form-control','placeholder'=>trans('user.country'),
                                     'required' => 'required'])
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
                                    Form::text('city',old('city',$store->city),['class'=>'form-control','placeholder'=>trans('user.city')])
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
                                    Form::text('state',old('state',$store->state),['class'=>'form-control','placeholder'=>trans('user.state')])
                                    !!}
                                </div>
                            </div>
                            <br>
                            <div class='form-group'>
                                <img src='{{Storage::url($store->image)}}' height='300' width='300'/>
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
                                    =>trans('user.business')],old('type',$store->type),['class'=>'form-control','placeholder'=>trans('user.type')])
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
                                    Form::text('business',old('business', $store->business),['class'=>'form-control','placeholder'=>trans('user.business')])
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
                                    Form::text('address1',old('address1', $store->address1),['class'=>'form-control','placeholder'=>trans('user.address1')])
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
                                    Form::text('address2',old('address2', $store->address2),['class'=>'form-control','placeholder'=>trans('user.address2')])
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
                                    Form::text('address3',old('address3', $store->address3),['class'=>'form-control','placeholder'=>trans('user.address3')])
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
                                    Form::text('phone1',old('phone1', $store->phone1),['class'=>'form-control','placeholder'=>trans('user.phone1')])
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
                                    Form::text('phone2',old('phone2', $store->phone2),['class'=>'form-control','placeholder'=>trans('user.phone2')])
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
                                    Form::text('phone3',old('phone3', $store->phone3),['class'=>'form-control','placeholder'=>trans('user.phone3')])
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
                                    Form::textarea('description',old('description', $store->description),['class'=>'form-control','placeholder'=>trans('user.about_store')])
                                    !!}
                                </div>
                            </div>
                            <br />
                            <div class="form-group">
                                <input value="@lang('user.update')" type="submit" class="btn btn-success" />
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
@endsection
