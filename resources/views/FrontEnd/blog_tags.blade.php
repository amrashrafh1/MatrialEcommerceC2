@extends('layouts.app')
@section('content')
@if(isset($tags))
@livewire('front-end.blog-tags', ['tag'=>$tags])
@else
@livewire('front-end.blog-tags')
@endif
@endsection
