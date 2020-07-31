<div wire:ignore style='width: 100%;' class="tm-related-products-carousel section-products-carousel" id="tm-related-products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:7,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#tm-related-products-carousel .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:767,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:780,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
    <section class="related">
        <header class="section-header">
            <h2 class="section-title">@lang('user.Related_products')</h2>
            <nav class="custom-slick-nav"></nav>
        </header>
        <!-- .section-header -->
        <div class="products">
            @foreach($related as $product)
            <div class="product">
                <div class="yith-wcwl-add-to-wishlist">
                    <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                        Wishlist</a>
                </div>
                <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                    <img src="{{Storage::url($product->image)}}" style='width:224px;height:197px;'
                    class="wp-post-image" alt="">
                    <span class="price">
                        @if(isset($product->discount))
                        <ins>
                            <span class="amount">{!! curr($product->priceDiscount()) !!}</span>
                        </ins>
                        <del>
                            <span class="amount">{!! curr($product->sale_price) !!}</span>
                        </del>
                        @else
                        <ins>
                            <span class="amount">{!! curr($product->sale_price) !!}</span>
                        </ins>
                        @endif
                    </span>
                    <!-- /.price -->
                    <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>
                </a>
                <div class="hover-area">
                    @if($product->IsVariable())
                    <a class="button add_to_cart_button" href='{{url('/'. $product->slug)}}'
                        rel="nofollow">Add to cart</a>
                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                    @else
                    <a class="button add_to_cart_button" wire:click='addCart({{$product->id}})'
                        rel="nofollow">Add to cart</a>
                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                    @endif
                </div>
            </div>
            @endforeach
            <!-- /.product-outer -->
        </div>
    </section>
    <!-- .single-product-wrapper -->
</div>
