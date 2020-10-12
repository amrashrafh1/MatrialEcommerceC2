@extends('Admin.layouts.app', ['activePage' => 'countrie-management', 'titlePage' => trans('admin.countries')])
@section('content')

    <div class="container-fluid pt-8 mt-5">
        <div class="col-md-12">
            <div class="widget-extra body-req card light bordered">
                <div class="card-title">
                    <div class="caption">
                        <span class="caption-subject bold uppercase font-dark">{{$title}}</span>
                    </div>
                    <div class="actions">
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
                                        'route' => ['countries.destroy', $rows->id]
                                        ]) !!}
                                        {!! Form::submit(trans('admin.approval'), ['class' => 'btn btn-danger']) !!}
                                        <a class="btn btn-default" data-dismiss="modal">{{trans('admin.cancel')}}</a>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <a class="btn btn-circle btn-icon-only btn-default" href="{{aurl('/countries')}}" data-toggle="tooltip"
                           title="{{trans('admin.show_all')}}   {{trans('admin.users')}}">
                            <i class="fa fa-list"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                    <ul class="list-group table-bordered">
                        <li class="list-group-item"><span style="font-weight: 700">@lang('admin.name') :</span> {{$rows->country_name}}</li>
                        <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.nativeName') :</span> {{$rows->nativeName}}</li>
                        <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.callingCodes') :</span>
                        @foreach($rows->callingCodes as $code)
                            +{{ $code}}
                        @endforeach
                    </li>
                        <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.currencies') :</span><br/>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col"><b class="mr-3">@lang('admin.code') : </b></th>
                                        <th scope="col"><b class="mr-3">@lang('admin.name') : </b></th>
                                        <th scope="col"><b class="mr-3">@lang('admin.symbol') : </b ></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rows->currencies as $currency)
                                        <tr>
                                            <th scope="row">{{ $currency['code']}}</th>
                                            <td>{{ $currency['name']}}</td>
                                            <td>{{ $currency['symbol']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                    </li>
                    <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.alpha3Code') :</span> {{$rows->alpha3Code}}</li></li>
                    <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.region') :</span> {{$rows->region}}</li></li>
                    <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.subregion') :</span> {{$rows->subregion}}</li></li>
                    <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.languages') :</span><br/>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col"><b class="mr-3">@lang('admin.iso639_1') : </b></th>
                                <th scope="col"><b class="mr-3">@lang('admin.iso639_2') : </b></th>
                                <th scope="col"><b class="mr-3">@lang('admin.name') : </b ></th>
                                <th scope="col"><b class="mr-3">@lang('admin.nativeName') : </b ></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows->languages as $lang)
                                <tr>
                                    <th scope="row">{{ $lang['iso639_1']}}</th>
                                    <td>{{ $lang['iso639_2']}}</td>
                                    <td>{{ $lang['name']}}</td>
                                    <td>{{ $lang['nativeName']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </li>
                    <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.latlng') :</span>
                        @foreach($rows->latlng as $code)

                            <span class="mr-3">{{ $code}}</span>
                        @endforeach
                    </li>
                        <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.timezones') :</span>
                            @foreach($rows->timezones as $code)
                                <span class="mr-3">{{ $code}}</span>
                            @endforeach
                        </li>
                        <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.flag') :</span><img style="width:60px" src="{{$rows->flag}}"></li>
                        <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.population') :</span> {{$rows->population}}</li>
                    <li class="list-group-item border-bottom"><span style="font-weight: 700">@lang('admin.capital') :</span> {{$rows->capital}}</li>
                    </ul>
                    </div>
                        <div class="col-md-6">
                            <div id='map'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <style>
        #map {
           margin-top: 0;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />

    @push('js')
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        <script>
            var planes = [
                ["7C6B07",<?php foreach($rows->latlng as $lng){echo $lng . ',';}?>],
            ];

            var map = L.map('map').setView([<?php foreach($rows->latlng as $lng){echo $lng . ',';}?>], 3);
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
