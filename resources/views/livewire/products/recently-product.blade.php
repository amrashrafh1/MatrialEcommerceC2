<section style='width: 100%;' class="section-landscape-products-carousel recently-viewed" id="recently-viewed" wire:ignore>
    <header class="section-header">
        <h2 class="section-title">@lang('user.Recently_viewed_products')</h2>
        <nav class="custom-slick-nav"></nav>
    </header>
    <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:2,&quot;dots&quot;:true,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-{{$direction == 'right'?'right':'left'}}\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-{{$direction == 'right'?'left':'right'}}\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#recently-viewed .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1700,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
        <div class="container-fluid">
            <div class="woocommerce columns-5">
                <div class="products">
                    @foreach($recently_viewed as $product)
                    <div class="landscape-product product">
                        <a class="woocommerce-LoopProduct-link" href="{{route('show_product',$product->slug)}}" target="_blank">
                            <div class="media">
                                <img class="wp-post-image" src="{{Storage::url($product->image)}}" alt="">
                                <div class="media-body">
                                    <span class="price">
                                        @if($product->available_discount())
                                                    <ins>
                                                        <span class="amount">{!! curr($product->priceDiscount()) !!}</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">{!! curr($product->calc_price()) !!}</span>
                                                    </del>
                                                    @else
                                                    <ins>
                                                        <span class="amount">{!! curr($product->calc_price()) !!}</span>
                                                    </ins>
                                                @endif
                                    </span>
                                    <!-- .price -->
                                    <h2 class="woocommerce-loop-product__title">{{$product->name}}</h2>
                                    <div class="techmarket-product-rating">
                                        <div title="Rated 0 out of 5" class="star-rating">
                                            <span style="width:{{$product->ratings->avg('rating') * 2 * 10}}%">
                                                <strong class="rating">0</strong> out of 5</span>
                                        </div>
                                        <span class="review-count">({{$product->ratings->count()}})</span>
                                    </div>
                                    <!-- .techmarket-product-rating -->
                                </div>
                                <!-- .media-body -->
                            </div>
                            <!-- .media -->
                        </a>
                        <!-- .woocommerce-LoopProduct-link -->
                    </div>
                    <!-- .landscape-product -->
                    @endforeach
                </div>
            </div>

            <!-- .woocommerce -->
        </div>
        <!-- .container-fluid -->
    </div>
    <!-- .products-carousel -->

</section>
