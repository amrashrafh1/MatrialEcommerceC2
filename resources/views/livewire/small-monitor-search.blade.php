<div class="site-search"  style="">
    <div class="widget woocommerce widget_product_search" style='z-index:1001;'>
        <form role="search"  class="woocommerce-product-search">
            <label class="screen-reader-text" for="woocommerce-product-search-field-0">@lang('user.Search_for:')</label>
            <input type="search" id="woocommerce-product-search-field-0" class="search-field" wire:model='smallSearch'
                placeholder="@lang("user.I'm_shopping_for..")" value="" name="s" autocomplete="off"/>
            <input type="submit" value="Search" />
            <input type="hidden" name="post_type" value="product" />
        </form>
    </div>
    <!-- .widget -->
    <div style="@if(count($results) > 0) display:block;height:400px;
     @else display:none; height:auto; @endif position:absolute; width:100%;
     z-index:1000;background:#f6f6f6; overflow-y:scroll;"
        id="search-result2">
        <div id="loading" wire:loading>
            <div class="loader"></div>
        </div>
        @if(count($results) > 0)
        @forelse($results as $tag)
        <div class='search-product' style="padding :10px 10px 0; margin:  10px 0; width:100%;">
            <a href="{{route('tags', $tag->slug)}}" class="row">
                <div class="col-md-8">
                    {{$tag->name}}
                </div>
            </a>
        </div>
        @empty
        no result
        @endforelse
        <div class="">
            <div class="search-pagination">
                <nav class="woocommerce-pagination">
                    {{ $results->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</div>

@push('js')
<script>
    $(document).mouseup(function (e) {
        var container = $("#search-result2");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });
    $("#woocommerce-product-search-field-0").click(function () {
        var container = $("#search-result2");
        container.show();
        container.css('paddingTop','49px');
    });

</script>
@endpush
