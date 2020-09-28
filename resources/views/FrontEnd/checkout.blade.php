@extends('layouts.app')
@section('content')
@livewire('checkout-page', ['payment' => $payment])
@endsection
