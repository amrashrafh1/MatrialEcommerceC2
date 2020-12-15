@extends('Admin.layouts.app', ['activePage' => 'stores-management', 'titlePage' => trans('admin.users')])
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
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/user/create')}}"
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
                                    'route' => ['user.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/user')}}" data-toggle="tooltip"
                        title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body form">
                <div class="col-md-12">

                    {!! Form::open(['url'=>route('user.update',
                    $rows->id),'method'=>'put','id'=>'users','files'=>true,'class'=>'form-horizontal
                    form-row-seperated']) !!}
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('name',trans('admin.name'),['class'=>' control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!! Form::text('name', $rows->name
                            ,['class'=>'form-control','placeholder'=>trans('admin.name')]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-md-2">
                            {!! Form::label('last_name',trans('admin.last_name'),['class'=>'control-label']) !!}
                        </div>
                        <div class="col-md-10">
                            {!!
                            Form::text('last_name',$rows->last_name,['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('email',trans('admin.email'),['class'=>' control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!! Form::email('email', $rows->email
                            ,['class'=>'form-control','placeholder'=>trans('admin.email')]) !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('password',trans('admin.password'),['class'=>' control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::password('password',['class'=>'form-control','placeholder'=>trans('admin.password')])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <div class="col-2">
                            {!! Form::label('password_confirmation',trans('admin.password_confirmation'),['class'=>'
                            control-label']) !!}
                        </div>
                        <div class="col-md-9">
                            {!!
                            Form::password('password_confirmation',['class'=>'form-control','placeholder'=>trans('admin.password')])
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
                            Form::text('phone',$rows->phone,['class'=>'form-control', 'placeholder' => '+1 (769)
                            458-7246'])
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
                            Form::text('address',$rows->address,['class'=>'form-control'])
                            !!}
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <img class=" img-responsive" src="{{Storage::url($rows->image)}}" />
                    </div>
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
                            <label for="select3 control-label">{{trans('admin.roles')}}</label>
                        </div>
                        <div class="col-md-10">
                            <select class="form-control" id="select3" name="role">
                                @foreach(\App\Role::get() as $role)
                                <option value="{{$role->name}}" {{($rows->hasRole($role->name)?'selected':'')}}>
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
                        'users',
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
                        'attribute_families',
                        'adzs',
                        'sliders',
                        'contact_us',
                        'ourworks',
                        'cmss',
                        'discounts',
                        'payments',
                        'sellers-app',
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
                                        <option value="{{$per . '-' . $map}}"
                                            {{($rows->hasPermission($per . '-' . $map)?'selected':'')}}>{{$per}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div id="per"></div>
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
