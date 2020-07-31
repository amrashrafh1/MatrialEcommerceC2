<div wire:ignore>
    <!-- /.banners -->
    <section class="section-hot-new-arrivals section-products-carousel-tabs techmarket-tabs">
        <div class="section-products-carousel-tabs-wrap">
            <header class="section-header">
                <h2 class="section-title">@lang('user.Trending_Now')</h2>
                <ul role="tablist" class="nav justify-content-end">
                    <li class="nav-item"><a class="nav-link active" href="#tab-59f89f09740"
                            data-toggle="tab">@lang('user.Top_20')</a></li>
                    @foreach($categories as $category)
                    <li class="nav-item"><a class="nav-link" href="#tab-59f89f09{{$category->id}}" data-toggle="tab">{!!
                            $category->name !!}</a></li>
                    @endforeach
                </ul>
            </header>
            <!-- .section-header -->
            <div class="tab-content">
                <div id="tab-59f89f09740" class="tab-pane active" role="tabpanel">
                    <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products"
                        data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:7,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:700,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:780,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
                        <div class="container-fluid">
                            <div class="woocommerce">
                                <div class="products">
                                    @foreach($products as $product)
                                    <div class="product">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                Wishlist</a>
                                        </div>
                                        <a href="{{route('show_product', $product->slug)}}" class="woocommerce-LoopProduct-link">
                                            <img src="{{Storage::url($product->image)}}"
                                             style="height:197px;width:224px;" class="wp-post-image" alt="" >
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
                                                rel="nofollow">Add to cart
                                            </a>
                                            <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- /.product-outer -->
                                </div>
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .container-fluid -->
                    </div>
                    <!-- .products-carousel -->
                </div>
                <!-- .tab-pane -->
                @foreach($categories as $category)
                <div id="tab-59f89f09{{$category->id}}" class="tab-pane" role="tabpanel">
                    <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products"
                        data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:7,&quot;slidesToScroll&quot;:7,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:700,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:780,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
                        <div class="container-fluid">
                            <div class="woocommerce">
                                <div class="products">
                                    @foreach($category->products->take(20) as $product)
                                    <div class="product">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                Wishlist</a>

                                        </div>
                                        <a href="{{route('show_product', $product->slug)}}" class="woocommerce-LoopProduct-link">
                                            <img src="{{Storage::url($product->image)}}"
                                             style="height:197px;width:224px;" class="wp-post-image" alt="">
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
                            <!-- .woocommerce -->
                        </div>
                        <!-- .container-fluid -->
                    </div>
                    <!-- .products-carousel -->
                </div>
                <!-- .tab-pane -->
                @endforeach

            </div>
            <!-- .tab-content -->
        </div>
        <!-- .section-products-carousel-tabs-wrap -->
    </section>
</div>
