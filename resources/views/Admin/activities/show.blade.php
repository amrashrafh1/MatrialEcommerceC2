@extends('Admin.layouts.app', ['activePage' => 'activities-management', 'titlePage' => trans('admin.activities')])
@section('content')
<div class="container-fluid mt-6 pt-8">
    <div class="col-md-12">
        <h2>{{$row->description}}</h2>
        @foreach($row->properties as $index => $prop)
        <div class='card'>
            <div class='card-header'>
                <h3 class='card-title'>@if($loop->first) @lang('admin.attributes') @else @lang('admin.old') @endif</h3>
            </div>
            <div class='card-body'>
                @foreach($prop as $key => $value)
                    {{$key}} : {{$value}} <br/>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>
@stop
