@foreach(json_decode($languages) as $lang)
    {{$lang->iso639_1}}<br/>
    {{$lang->iso639_2}}<br/>
    {{$lang->name}}<br/>
    {{$lang->nativeName}}<br/>
@endforeach
