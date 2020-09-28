<div class='mb-5'>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <input type="text" wire:keydown.enter="add_attribute($event.target.value)" name="attribute"
        placeholder="No Attribute yet in {{$properties['name']}}" class="attribute_input mb-3 mt-4">
    <ul class="tags">
        @foreach($attributes as $attribute)
        <li><a class="tag attribute_{{$attribute->id}}"><span
                    class="attr_lang">{{$attribute->getTranslation('name', $localeCode)}}</span>
                <input style="display:none" class='attr_lang_input'
                    value="{{$attribute->getTranslation('name', $localeCode)}}" type="text"
                    wire:keydown.enter="update_attribute_lang($event.target.value, '{{$localeCode}}', {{$attribute->id}})" />
                <span @if($localeCode==='en' ) wire:click='remove({{$attribute->id}})' @else
                    wire:click='removeLang({{$attribute->id}}, "{{$localeCode}}")' @endif style="cursor:pointer;"> <i
                        class="fa fa-close"></i></span></a></li>

        @endforeach
    </ul>
    @endforeach
</div>


@push('js')
<script>
    $(document).ready(function () {
        $(".attr_lang").click(function (e) {
            e.preventDefault();
            var txt = $(this).html();
            var input = $(this).siblings('input');
            $(this).hide();
            $(input).show();
        });
        $(".attr_lang_input").keypress(function (e) {
            if (e.which == 13) {
                $(this).hide();
                $(this).siblings('.attr_lang').show();
                //$('.attr_lang').show();
                $(this).siblings('.attr_lang').text($(this).val());

            }
        });
    });


</script>
@endpush
