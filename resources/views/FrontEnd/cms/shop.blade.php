@extends('layouts.app')
@section('content')
@if(isset($cms))
@livewire('c-m-s', ['cms'=>$cms])
@else
@livewire('c-m-s')
@endif
@endsection
