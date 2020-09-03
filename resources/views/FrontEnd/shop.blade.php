@extends('layouts.app')
@section('content')
@if(isset($category))
@livewire('shop', ['category'=>$category])
@else
@livewire('shop')
@endif
@endsection
