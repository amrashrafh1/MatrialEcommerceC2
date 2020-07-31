@extends('Admin.layouts.app', ['activePage' => 'seller-management', 'titlePage' => trans('admin.create')])
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
                    <a href="{{aurl('/seller')}}" class="btn btn-circle btn-icon-only btn-default"
                        tooltip="{{trans('admin.show_all')}}" title="{{trans('admin.show_all')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!! Form::open(['url'=>route('seller.store'),'id'=>'sellers','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('name',trans('admin.name'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('name',old('name'),['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('last_name',trans('admin.last_name'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('last_name',old('last_name'),['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('email',trans('admin.email'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::email('email',old('email'),['class'=>'form-control'])
                            !!}
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('password',trans('admin.password'),['class'=>' control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::password('password',['class'=>'form-control'])
                            !!}
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <div class="col-md-2">

                            {!! Form::label('password_confirmation',trans('admin.password_confirmation'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::password('password_confirmation',['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('phone',trans('admin.phone'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('phone',old('phone'),['class'=>'form-control', 'placeholder' => '+1 (769) 458-7246'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('address',trans('admin.address'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('address',old('address'),['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
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
                            <label for="exampleFormControlSelect1 control-label">{{trans('admin.roles')}}</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" id="select3" name="role">
                                @foreach(\App\Role::get() as $role)
                                <option value="{{$role->name}}" {{($role->name == 'seller')?'selected':''}}>
                                    {{$role->display_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-12">
                        <h3 class="card-header card-header-primary">{{(trans('admin.permissions'))}}:</h3>
                        <br>
                        @php
                            $maps = [
                            'sellers',
                            'categories',
                            'tradmarks',
                            'malls',
                            'countries',
                            'products',
                            'cities',
                            'shippingCompanies',
                            'manufacturers',
                             'settings',
                             'orders',
                             'methods',
                             'zones',
                             'attribute_families'
                             ];
                            $permissions = ['read','create', 'update', 'delete']
                        @endphp
                        <div id="permission">
                        @foreach($maps as $map)
                        <div class="form-group row">
                            <div class="col-md-2">
                                <label for="exampleFormControlSelect2">{{(trans('admin.'.$map))}}</label>
                            </div>
                            <div class="col-md-10">
                                <select multiple class="form-control" id="exampleFormControlSelect2"
                                    name="permissions[]" style="height:100px;">
                                    @foreach($permissions as $per)
                                    <option value="{{$per . '-' . $map}}">{{$per}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endforeach
                        </div>
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
