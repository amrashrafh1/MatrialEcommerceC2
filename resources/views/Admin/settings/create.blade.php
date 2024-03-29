@extends('Admin.layouts.app', ['activePage' => 'settings-management', 'titlePage' => trans('admin.settings')])
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
                    <a href="{{aurl('/dashboard')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                    <a href="{{aurl('/coupons')}}" class="btn btn-circle btn-icon-only btn-primary"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-plus"></i>
                        @lang('admin.add_coupons')
                    </a>
                    <a href="{{route('cmss.index')}}" class="btn btn-circle btn-icon-only btn-primary"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-plus"></i>
                        @lang('admin.add_event')
                    </a>
                    @if(isset($rows->shipping))
                    <a href="{{route('methods.edit',$rows->shipping->id)}}"
                        class="btn btn-circle btn-icon-only btn-primary" tooltip="{{trans('admin.show_all')}}"
                        title="{{trans('admin.show_all')}}">
                        <i class="fa fa-plus"></i>
                        @lang('admin.edit_shipping')
                    </a>
                    @endif
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">
                    {!!
                    Form::open(['url'=>route('settings_update'),'method'=>
                    'patch','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="sitename"
                                class=" control-label">@lang('admin.sitename_in_'.$properties['name'])</label>
                        </div>
                        <div class="col-md-10">

                            <input type="text" name="sitename_{{$localeCode}}" class="form-control"
                                placeholder="@lang('admin.sitename_in_'.$properties['name'])"
                                value="{{(isset($rows))?($rows->getTranslation('sitename', $localeCode) !== null)?$rows->getTranslation('sitename', $localeCode):old('sitename_'.$localeCode):''}}"
                                {{($localeCode === 'en') ? 'required':''}}>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <img class="img-responsive" src="{{Storage::url(($rows)?$rows->logo:'')}}" />
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('logo',trans('admin.logo'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile" name="logo">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <img class="img-responsive" src="{{Storage::url(($rows)?$rows->icon:'')}}" />
                    </div>
                    <br />
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('icon',trans('admin.icon'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file" style="border: 1px solid #e6e6e6;">
                                <input type="file" class="custom-file-input" id="customFile2" name="icon">
                                <label class="custom-file-label" for="customFile2">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('email',trans('admin.email'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::email('email',(isset($rows->email))?$rows->email:old('email'),['class'=>'form-control','placeholder'=>trans('admin.email')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('mobile',trans('admin.mobile'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('mobile',(isset($rows->mobile))?$rows->mobile:old('mobile'),['class'=>'form-control','placeholder'=>trans('admin.mobile')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('location',trans('admin.address'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('location',(isset($rows->location))?$rows->location:old('location'),['class'=>'form-control','placeholder'=>trans('admin.address')])
                            !!}
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('fees',trans('admin.fees_percentage'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::number('fees',(isset($rows->fees))?$rows->fees:old('fees'),['class'=>'form-control','placeholder'=>trans('admin.fees_percentage')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('seller_countries',trans('admin.sellers_countries'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            <select multiple="multiple" name="country_id[]" class="form-control" style="height:100px;">
                                @foreach(\App\Country::get() as $country)
                                <option value="{{$country->id}}" @if(isset($rows))@if(in_array($country->id,
                                    $rows->seller_countries->pluck('country_id')->toArray()))selected="selected"@endif
                                    @endif>{{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('default_shipping',trans('admin.default_shipping'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('default_shipping',[1 => trans('admin.yes'), 0
                            =>trans('admin.no')],(isset($rows->default_shipping))?$rows->default_shipping:old('default_shipping'),['class'=>'form-control','placeholder'=>trans('admin.default_shipping')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('shipping_method',trans('admin.shipping_method'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('shipping_method',\App\Shipping_methods::pluck('name','id'),($rows)?old('shipping_method', $rows->shipping_method):old('shipping_method'),['class'=>'form-control','placeholder'=>trans('admin.shipping_method')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('paypal',trans('admin.paypal'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('paypal',[1 => 'On', 0
                            =>'Off'],(isset($rows->paypal))?$rows->paypal:old('paypal'),['class'=>'form-control','placeholder'=>trans('admin.paypal')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('stripe',trans('admin.stripe'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('stripe',[1 => 'On', 0
                            =>'Off'],(isset($rows->stripe))?$rows->stripe:old('stripe'),['class'=>'form-control','placeholder'=>trans('admin.stripe')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('facebook',trans('admin.facebook'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::url('facebook',(isset($rows->facebook))?$rows->facebook:old('facebook'),['class'=>'form-control','placeholder'=>trans('admin.facebook')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('twitter',trans('admin.twitter'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::url('twitter',(isset($rows->twitter))?$rows->twitter:old('twitter'),['class'=>'form-control','placeholder'=>trans('admin.twitter')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('facebook_login',trans('admin.facebook_login'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('facebook_login',[1 => 'On', 0
                            =>'Off'],(isset($rows->facebook_login))?$rows->facebook_login:old('facebook_login'),['class'=>'form-control','placeholder'=>trans('admin.facebook_login')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('twitter_login',trans('admin.twitter_login'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('twitter_login',[1 => 'On', 0
                            =>'Off'],(isset($rows->twitter_login))?$rows->twitter_login:old('twitter_login'),['class'=>'form-control','placeholder'=>trans('admin.twitter_login')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('google_login',trans('admin.google_login'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('google_login',[1 => 'On', 0
                            =>'Off'],(isset($rows->google_login))?$rows->google_login:old('google_login'),['class'=>'form-control','placeholder'=>trans('admin.google_login')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('github',trans('admin.github'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('github',[1 => 'On', 0
                            =>'Off'],(isset($rows->github))?$rows->github:old('github'),['class'=>'form-control','placeholder'=>trans('admin.github')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('system_status',trans('admin.system_status'),['control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::select('system_status',['open'=> 'open',
                            'close'=>'close'],(isset($rows->system_status))?$rows->system_status:old('system_status'),['class'=>'form-control','placeholder'=>trans('admin.system_status')])
                            !!}
                        </div>
                    </div>
                    <br>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-2">
                            <label for="system_message" class=" control-label">@lang('admin.system_message_'.
                                $properties['name'])</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="system_message_{{$localeCode}}" class="form-control"
                                placeholder="@lang('admin.system_message_'. $properties['name'])"
                                id="system_message_{{$localeCode}}">
                                @if($rows)
                                {!! old('system_message_'.$localeCode, $rows->getTranslation('system_message', $localeCode)) !!}
                                @else
                                {!! old('system_message_'.$localeCode) !!}
                                @endif
                            </textarea>
                        </div>
                    </div>
                    @endforeach
                    <br>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="meta_tag_{{$localeCode}}"
                                class=" control-label">@lang('admin.meta_tag_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="meta_tag_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('admin.meta_tag_'.$properties['name'])"
                                value="{{($rows)?old('meta_tag_'.$localeCode, $rows->getTranslation('meta_tag', $localeCode)):old('meta_tag_'.$localeCode)}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="meta_description_{{$localeCode}}"
                                class=" control-label">@lang('admin.meta_description_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="meta_description_{{$localeCode}}" class="form-control mb-4"
                                placeholder="@lang('admin.meta_description_'.$properties['name'])"
                                value="{{($rows)?old('meta_description_'.$localeCode, $rows->getTranslation('meta_description', $localeCode)):old('meta_description_'.$localeCode)}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="keywords_{{$localeCode}}"
                                class=" control-label">@lang('admin.meta_keywords_'.$properties['name'])
                            </label>
                        </div>
                        <div class="col-md-9">
                        <input type="text" name="meta_keyword_{{$localeCode}}" value="{{($rows)?old('meta_keyword_'.$localeCode, $rows->getTranslation('meta_keyword', $localeCode)):old('meta_keyword_'.$localeCode)}}" data-role="tagsinput">
                        </div>
                    </div>
                    @endforeach
                    <input type='hidden' value='{{($setting)?$setting->id:NULL}}' />
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-10">
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
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="{{url('/')}}/css/bootstrap-tagsinput.css">
<script src="{{url('/')}}/js/bootstrap-tagsinput.min.js"></script>
<script>
     <?php foreach(\LaravelLocalization::getSupportedLocales() as $locale => $props) { ?>
            CKEDITOR.replace('system_message_{{$locale}}');

        <?php } ?>
        $('form').keypress(function(e){
      if(e.keyCode==13)
      //$('#linkadd').click();
      e.preventDefault();
    });
</script>
@endpush
@stop
