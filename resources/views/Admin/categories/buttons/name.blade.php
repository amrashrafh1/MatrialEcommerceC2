@php
    $category = \App\Category::where('id', $id)->first();
@endphp
{{$category->name}}
