<form wire:submit.prevent='search' class="navbar-search" style="position:relative;" action='' method='post'>

    <label class="sr-only screen-reader-text" for="search">Search for:</label>
    <div class="input-group">
        <input type="text" id="search" wire:model='search' autocomplete="off" name="search" required
            class="form-control search-field product-search-field"  value=""
            placeholder="@lang("user.I'm_shopping_for..")" />
            @if(!blank($this->slug))
            <div class="input-group-addon search-categories popover-header">
                <div class='postform'>
                    <a href='{{route('shop')}}' style='font-size:13px;' class='btn btn-primary'
                        >@lang('user.on') {{$setting->sitename}}</a>
                    <a href='#' class='btn btn-primary disabled' style='font-size:13px; background:#0059BD;'
                        disabled> @lang('user.On_this_store')</a>
                </div>
            </div>
            @endif
        <!-- .input-group-addon -->
        <div class="input-group-btn input-group-append">
            <input type="hidden" id="search-param" name="post_type" value="product" />
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i>
                <span class="search-btn">@lang('user.search')</span>
            </button>
        </div>
        <!-- .input-group-btn -->
    </div>
    <!-- .input-group -->
    <div style="position: absolute; height:auto; width:100%; z-index:100000;background:#f6f6f6; overflow:auto;"
        id="search-result">
        <div id="loading" wire:loading>
            <div class="loader" ></div>
        </div>
        @if(count($tags)>0)
        @forelse($tags as $tag)
        <div class='search-product' style="padding :10px 0 10px; margin:  10px 0; width:100%;">
            @if(!blank($this->slug))
                <a href="{{route('show_product', $tag->slug)}}" target="_blank" class="row" style="padding-left :20px;">
                    <div class="col-md-3">
                    <img src='{{Storage::url($tag->image)}}' width='90' height='90'>
                    </div>
                    <div class="col-md-9 prices">
                        {{$tag->name}}
                        <div class="price">
                            @if($tag->available_discount())
                            <ins>
                                <span class="amount">{!! curr($tag->priceDiscount()) !!}</span>
                            </ins>
                            <del>
                                <span class="amount">{!! curr($tag->calc_price()) !!}</span>
                            </del>
                            @else
                            <ins>
                                <span class="amount">{!! curr($tag->calc_price()) !!}</span>
                            </ins>
                            @endif
                        </div>
                    </div>
                </a>
            @else
                <a href="{{route('tags', $tag->slug)}}" class="row"  style="padding-left :20px;">
                    <div class="col-md-8">
                        {{$tag->name}}
                    </div>
                </a>
            @endif
        </div>
        @empty
        no result
        @endforelse
        <div class="">
            <div class="search-pagination">
                <nav class="woocommerce-pagination">
                    {{ $tags->links() }}
                </nav>
            </div>
        </div>
        @endif
    </div>
</form>
<style>
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
        position         : absolute;
        width            : 100%;
        height           : 100%;
        background       : #999;
        opacity          : 0.8;
        top              : 0;
        left             : 0;
        right            : 0;
        bottom           : 0;
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
        width        : 120px;
        height       : 120px;
        animation    : spin 2s linear infinite;
        margin       : 20% auto;

    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
    div.price .amount {
        font-size:14px !important;
    }
    div.prices {
        font-size:14px !important;
    }
</style>
@push('js')
<script>
    $(document).mouseup(function (e) {
        var container = $("#search-result");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
    });
    $("#search").click(function () {
        var container = $("#search-result");
        container.show();
    });

</script>
@endpush
