@php
$country = \App\Country::where('id', $country_id)->first()
@endphp
{{$country->country_name}}
