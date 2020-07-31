@extends('layouts.app')
@section('content')
@if(isset($tags))
@livewire('tag', $tags)
@else
@livewire('tag')
@endif
@endsection
