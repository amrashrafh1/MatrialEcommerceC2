@extends('layouts.app')
@section('content')
@if(isset($category))
@livewire('shop', $category)
@else
@livewire('shop')
@endif
@endsection
