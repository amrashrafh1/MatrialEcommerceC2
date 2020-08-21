<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.Compare')
            </nav>
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="type-page hentry">
                        <header class="entry-header">
                            <div class="page-header-caption">
                                <h1 class="entry-title">@lang('user.Wishlist')</h1>
                            </div>
                        </header>
                        <!-- .entry-header -->
                        <div class="entry-content">
                            <form class="woocommerce" method="post" action="#">
                                <table class="shop_table cart wishlist_table">
                                    <thead>
                                        <tr>
                                            <th class="product-remove"></th>
                                            <th class="product-thumbnail"></th>
                                            <th class="product-name">
                                                <span class="nobr">@lang('user.Product_Name')</span>
                                            </th>
                                            <th class="product-price">
                                                <span class="nobr">
                                                    @lang('user.Unit_Price')
                                                </span>
                                            </th>
                                            <th class="product-stock-status">
                                                <span class="nobr">
                                                    @lang('user.Stock_Status')
                                                </span>
                                            </th>
                                            <th class="product-add-to-cart"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($wishlists as $product)
                                        <tr>
                                            <td class="product-remove">
                                                <div>
                                                    <a title="Remove this product" class="remove remove_from_wishlist" style='cursor:pointer;' wire:click='removeWishlists({{$product->id}})'>X</a>
                                                </div>
                                            </td>
                                            <td class="product-thumbnail" style='margin-left:20px;'>
                                                <a href="{{route('show_product',$product->slug)}}">
                                                    <img alt="" class="wp-post-image"
                                                        src="{{Storage::url($product->image)}}" style="width: 180px; height:180px;">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a
                                                    href="{{route('show_product',$product->slug)}}">{{$product->name}}</a>
                                            </td>
                                            <td class="product-price">
                                                @if(isset($product->discount))
                                                @if($product->discount->condition ===
                                                'percentage_of_product_price'
                                                && $product->discount->start_at <= \Carbon\Carbon::now() && $product->
                                                    discount->expire_at > \Carbon\Carbon::now())
                                                    <ins>
                                                        <span class="amount">{!!
                                                            curr($product->priceDiscount()) !!}</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">{!! curr($product->sale_price)
                                                            !!}</span>
                                                    </del>
                                                    @elseif($product->discount->condition === 'fixed_amount'
                                                    && $product->discount->start_at <= \Carbon\Carbon::now() &&
                                                        $product->discount->expire_at >
                                                        \Carbon\Carbon::now())
                                                        <ins>
                                                            <span class="amount">{!!
                                                                curr($product->priceDiscount()) !!}</span>
                                                        </ins>
                                                        <del>
                                                            <span class="amount">{!!
                                                                curr($product->sale_price) !!}</span>
                                                        </del>
                                                        @else
                                                        <ins>
                                                            <span class="amount">{!!
                                                                curr($product->sale_price) !!}</span>
                                                        </ins>
                                                        @endif
                                                        @else
                                                        <ins>
                                                            <span class="amount">{!!
                                                                curr($product->sale_price) !!}</span>
                                                        </ins>
                                                        @endif
                                            </td>
                                            <td class="product-stock-status">
                                                @if($product->stock > 0)
                                                    <span class="wishlist-in-stock">{{$product->stock}} @lang('user.in_stock')</span>
                                                    @else
                                                    <span class="stock text-danger">@lang('user.out_stock')</span>
                                                @endif
                                            </td>
                                            <td class="product-add-to-cart">
                                            <td>
                                                @if($product->IsVariable())
                                                <a class="button add_to_cart_button" href='{{route('show_product', $product->slug)}}'
                                                    rel="nofollow">Add to cart</a>
                                                @else
                                                <a class="button add_to_cart_button text-white" wire:click='addCart({{$product->id}})'
                                                    rel="nofollow">Add to cart</a>
                                                @endif
                                            </td>
                                            </td>
                                        </tr>
                                        @empty
                                        <div>
                                            <div class="alert-danger text-center">
                                                @lang('user.empty_wishlists')
                                            </div>
                                        </div>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <div class="yith-wcwl-share">
                                                    <h4 class="yith-wcwl-share-title">Share on:</h4>
                                                    <ul>
                                                        <li style="list-style-type: none; display: inline-block;">
                                                            <a title="Facebook"
                                                                href="https://www.facebook.com/sharer.php?s=100&amp;p%5Btitle%5D=My+wishlist+on+Tech+Market&amp;p%5Burl%5D=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F"
                                                                class="facebook" target="_blank"></a>
                                                        </li>
                                                        <li style="list-style-type: none; display: inline-block;">
                                                            <a title="Twitter"
                                                                href="https://twitter.com/share?url=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;text="
                                                                class="twitter" target="_blank"></a>
                                                        </li>
                                                        <li style="list-style-type: none; display: inline-block;">
                                                            <a onclick="window.open(this.href); return false;"
                                                                title="Pinterest"
                                                                href="http://pinterest.com/pin/create/button/?url=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;description=&amp;media="
                                                                class="pinterest" target="_blank"></a>
                                                        </li>
                                                        <li style="list-style-type: none; display: inline-block;">
                                                            <a onclick="javascript:window.open(this.href, &quot;&quot;, &quot;menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600&quot;);return false;"
                                                                title="Google+"
                                                                href="https://plus.google.com/share?url=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;title=My+wishlist+on+Tech+Market"
                                                                class="googleplus" target="_blank"></a>
                                                        </li>
                                                        <li style="list-style-type: none; display: inline-block;">
                                                            <a title="Email"
                                                                href="mailto:?subject=I+wanted+you+to+see+this+site&amp;body=http%3A%2F%2Flocalhost%2F%7Efarook%2Ftechmarket%2Fhome-v1.html%2Fwishlist%2Fview%2FD5ON1PW1PYO1%2F&amp;title=My+wishlist+on+Tech+Market"
                                                                class="email"></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <!-- .wishlist_table -->
                            </form>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .entry-content -->
                    </div>
                    <!-- .hentry -->
                </main>
                <!-- #main -->
            </div>

        </div>
        <!-- .row -->
    </div>
    <!-- Modal -->
</div>
