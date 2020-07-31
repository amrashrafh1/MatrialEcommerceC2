<section class="stretch-full-width section-products-carousel-with-bg 7-column-carousel-bg" wire:ignore>
    <div class="col-full">
        <div class="row">
            <header class="section-header">
                <h2 class="section-title">@lang('user.Make_dreams')
                    <br>
                    <span>@lang('user.your_reality.')</span>
                </h2>
                <img alt="" src="{{ url('/') }}/FrontEnd/img/bg-2.png">
            </header>
            <div class="products-carousel-with-bg">
                <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:7,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:780,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1201,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}},{&quot;breakpoint&quot;:1700,&quot;settings&quot;:{&quot;slidesToShow&quot;:6,&quot;slidesToScroll&quot;:6}}]}">
                    <div class="container-fluid">
                        <div class="woocommerce columns-6">
                            <div class="products">
                                @foreach($products as $product)
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                            Wishlist</a>

                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                            height="197" class="wp-post-image" alt="">
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
                                        <a class="add-to-compare-link" href="compare.html">Add to compare
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                <!-- /.product-outer -->
                            </div>
                        </div>
                        <!-- .woocommerce-->
                    </div>
                    <!-- .container-fluid -->
                </div>
                <!-- .products-carousel -->
            </div>
            <!-- .products-carousel-with-bg -->
        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</section>
