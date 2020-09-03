@extends('layouts.app')
@section('content')
@include('sweetalert::alert')

@livewire('products.show-product',['product'=>$product])
@endsection
