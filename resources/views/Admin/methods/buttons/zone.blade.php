@php
    $method = \App\Zone::find($zone_id);
@endphp
{{$method->name}}
