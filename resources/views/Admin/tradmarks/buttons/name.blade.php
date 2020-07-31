@php
    $tradmark = \App\Tradmark::where('id', $id)->first();
@endphp
{{$tradmark->name}}
