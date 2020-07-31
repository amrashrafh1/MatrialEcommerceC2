@extends('Admin.layouts.app', ['activePage' => 'zone-management', 'titlePage' => trans('admin.zones')])
@section('content')

<div class="container-fluid pt-8 mt-5">
    <div class="col-md-12">
        <div class="widget-extra body-req card light bordered">
            <div class="card-title">
                <div class="caption">
                    <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/zones/create')}}"
                        data-toggle="tooltip" title="{{trans('admin.create')}}">
                        <i class="fa fa-plus"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="{{route('zones.edit', $rows->id)}}"
                       data-toggle="tooltip" title="{{trans('admin.edit')}}">
                        <i class="fa fa-edit"></i>
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
                                    {{trans('admin.ask_del')}} {{trans('admin.id')}} {{$rows->id}} ؟

                                </div>
                                <div class="modal-footer">
                                    {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['zones.destroy', $rows->id]
                                    ]) !!}
                                    {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                    <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/zones')}}" data-toggle="tooltip"
                        title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <h3 class="mt-3 text-center">{{$rows->name}}</h3>
                <div class="col-sm-12">
                    <h4>@lang('admin.methods') :</h4>
                    <ul class="list-group">
                        @foreach($rows->methods as $method)
                        <li class="list-group-item  m-2">
                            <a class="p-2" href="{{route('methods.edit', $method->id)}}">- {{$method->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <br/>
                <div class="row">
                    <div class="col-md-6">
                        <h4>@lang('admin.countries') :</h4>
                        <ul class="list-group">
                            @foreach($rows->countries as $country)
                                <li class="list-group-item  m-2">
                                    <a class="p-2" href="{{route('countries.show', $country->id)}}">- {{$country->country_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div id='map'></div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <h4>@lang('admin.shippingCompanies') :</h4>
                    <ul class="list-group">
                        @foreach($rows->shippingcompanies as $company)
                            <li class="list-group-item  m-2">
                                <a class="p-2" href="{{route('shippingcompanies.edit', $company->id)}}">- {{$company->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />

    @push('js')
<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
<script>
    var planes = [
        <?php
        foreach($rows->countries as $country) {
            echo '[';
            echo '"'.$country->country_name.'"';
            echo ',';
            foreach($country->latlng as $lat) {
                echo $lat, ',';
            };
            echo '],';
            }?>
    ];

    var map = L.map('map').setView([33, 65], 3);
    mapLink =
        '<a href="http://openstreetmap.org">OpenStreetMap</a>';
    L.tileLayer(
        'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; ' + mapLink + ' Contributors',
            maxZoom: 18,
        }).addTo(map);

    for (var i = 0; i < planes.length; i++) {
        marker = new L.marker([planes[i][1],planes[i][2]])
            .bindPopup(planes[i][0])
            .addTo(map);
    }
</script>
    @endpush
@stop
