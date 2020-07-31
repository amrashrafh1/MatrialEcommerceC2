@php
    $city = \App\City::where('id', $id)->first();
@endphp
{{$city->city_name}}
