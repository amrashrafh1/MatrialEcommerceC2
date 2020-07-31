@php
    $currence = json_decode($currencies);
    @endphp
@foreach($currence as $currencies)
        <span style="font-weight: 700">Code :</span>    {!! $currencies->code !!}</br>
        <span style="font-weight: 700">Name : </span>   {!! $currencies->name !!}</br>
        <span style="font-weight: 700">symbol : </span>  {!! $currencies->symbol !!}
@endforeach
