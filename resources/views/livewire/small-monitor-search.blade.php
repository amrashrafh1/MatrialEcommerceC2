<div class="site-search"  style="">
    <div class="widget woocommerce widget_product_search" style='z-index:1001;'>
        <form role="search"  class="woocommerce-product-search">
            <label class="screen-reader-text" for="woocommerce-product-search-field-0">Search
                for:</label>
            <input type="search" id="woocommerce-product-search-field-0" class="search-field" wire:model='smallSearch'
                placeholder="Search products&hellip;" value="" name="s" autocomplete="off"/>
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
        @forelse($results as $product)
        <div class='search-product' style="pading :0 10px 0; margin:  10px 0; width:100%;">
            <a href="{{route('show_product', $product->slug)}}" class="row">
                <div class="col-md-3" style="pading : 0 10px; margin: 0 10px;">
                    <img src="{{Storage::url($product->image)}}" style="height:60px;width:60px;">
                </div>
                <div class="col-md-8">
                    {{$product->name}}
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
{{-- <style>
    .search-pagination {
        width: 100%;
    }

    .search-pagination .pagination .page-item button {
        position: relative !important;
        display: block !important;
        padding: .5rem .75rem !important;
        margin-left: -1px !important;
        line-height: 1.25 !important;
        color: #007bff !important;
        background-color: #fff !important;
        border: 1px solid #dee2e6 !important;
    }

    .search-product:hover {
        background: #0063d14d;
    }


    #loading {
        position: absolute;
        width: 100%;
        height: 100%;
        background: #999;
        opacity: 0.8;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        /* -ms-transform    : translateX(-50%)
        -webkit-transform: translateX(-50%);
        transform        : translateX(-50%) */
    }

    .loader {
        border: 16px solid #f3f3f3;
        /* Light grey */
        border-top: 16px solid #3498db;
        /* Blue */
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
        margin: 20% auto;

    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

</style> --}}
<style>
    .widget_product_search {

    }
</style>
@push('js')
<script>
    $(document).mouseup(function (e) {
        var container = $("#search-result2");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            console.log('clicked');
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
