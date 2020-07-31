@extends('Admin.layouts.app', ['activePage' => 'user-management', 'titlePage' => __('User Management')])
@section('content')

<div class="container-fluid mt-5 pt-8">
    <div class="col-md-12">
        <div class="widget-extra body-req portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/admins/create')}}"
                        data-toggle="tooltip" title="{{trans('admin.users')}}">
                        <i class="fa fa-plus"></i>
                    </a>


                    <span data-toggle="tooltip" title="{{trans('admin.delete')}}  {{trans('admin.users')}}">

                        <a data-toggle="modal" data-target="#myModal{{$users->id}}"
                            class="btn btn-circle btn-icon-only btn-default" href="">
                            <i class="fa fa-trash"></i>
                        </a>
                    </span>


                    <div class="modal fade" id="myModal{{$users->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="close" data-dismiss="modal">x</button>
                                    <h4 class="modal-title">{{trans('admin.delete')}}؟</h4>
                                </div>
                                <div class="modal-body">
                                    {{trans('admin.ask_del')}} {{trans('admin.id')}} {{$users->id}} ؟

                                </div>
                                <div class="modal-footer">
                                    {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['admins.destroy', $users->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/admins')}}" data-toggle="tooltip"
                        title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="card card-profile  overflow-hidden">
                <div class="card-body text-center cover-image" data-image-src="{{url('/')}}/Backend/assets/img/profile-bg.jpg">
                        <div class=" card-profile">
                            <div class="row justify-content-center">
                                <div class="">
                                    <div class="">
                                        <a href="#">
                                        <img src="{{url('/')}}/Backend/assets/img/faces/female/32.jpg" class="rounded-circle"
                                                alt="profile">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3 class="mt-3 text-white">{{$users->name}}</h3>
                        <p class="mb-4 text-white">
                            @foreach($users->roles as $role)
                                {{$role->display_name}}
                            @endforeach
                        </p>
                        <a href="{{route('admins.edit', $users->id)}}" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt" aria-hidden="true"></i>
                            Edit profile</a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
@stop
