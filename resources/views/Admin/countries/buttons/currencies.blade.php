{{-- @php
    $currence = json_decode($currencies);
@endphp --}}
@foreach($currencies as $currence)
        <span style="font-weight: 700">Code :</span>    {!! $currence['code'] !!} <br>
        <span style="font-weight: 700">Name : </span>   {!! $currence['name'] !!} <br>
        <span style="font-weight: 700">symbol : </span>  {!! $currence['symbol'] !!}
@endforeach
