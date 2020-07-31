@php
    $Post = \App\Post::where('id', $id)->first();
@endphp
{{$Post->slug}}
