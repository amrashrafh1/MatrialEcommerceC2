@extends('layouts.app')
@section('content')
@livewire('product-category', ['category'   => $category])
@endsection
