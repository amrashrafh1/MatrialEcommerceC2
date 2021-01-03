<div class="row section-products-carousel-widget-with-tabs" id="carousel-widget-with-tabs" wire:ignore>
    <div class="landscape-products-widget-block">
        <section class="section-landscape-products-widget-carousel type-2" id="section-products-carousel-widgets">
            <header class="section-header">
                <h2 class="section-title">@lang('user.Hand_picked_for_you')</h2>
                <nav class="custom-slick-nav"></nav>
            </header>
            <!-- .section-header -->
            <div class="products-carousel hand-picked-carousel" data-ride="tm-slick-carousel" data-wrap=".products"
                data-slick="{&quot;rows&quot;:6,&quot;slidesPerRow&quot;:2,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-{{$direction == 'right'?'right':'left'}}\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-{{$direction == 'right'?'left':'right'}}\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#section-products-carousel-widgets .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:750,&quot;settings&quot;:{&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:1190,&quot;settings&quot;:{&quot;rows&quot;:8,&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}}]}">
                <div class="container-fluid">
                    <div class="woocommerce columns-1">
                        <div class="products">
                            @foreach($handpicked as $product)
                            <div class="landscape-product-widget product">
                                <a class="woocommerce-LoopProduct-link" target="_blank"
                                    href="{{route('show_product', $product->slug)}}">
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
                                            <h2 class="woocommerce-loop-product__title">{{ $product->name }}</h2>
                                            <div class="techmarket-product-rating">
                                                <div title="Rated 0 out of 5" class="star-rating">
                                                    <span style="width:0%">
                                                        <strong class="rating">0</strong> out of 5</span>
                                                </div>
                                                <span class="review-count">(0)</span>
                                            </div>
                                            <!-- .techmarket-product-rating -->
                                        </div>
                                        <!-- .media-body -->
                                    </div>
                                    <!-- .media -->
                                </a>
                                <!-- .woocommerce-LoopProduct-link -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- .products-carousel -->
        </section>
    </div>
    <!-- .landscape-products-widget-block -->
    <div class="products-carousel-tabs-block">
        @if($stores)
            <section class="section-hot-new-arrivals section-products-carousel-tabs">
                <div class="section-products-carousel-tabs-wrap">
                    <header class="section-header">
                        <h2 class="section-title">@lang('user.your_favorite_sellers_and_stores')</h2>
                        <ul role="tablist" class="nav justify-content-end">
                            @foreach($stores as $store)
                            <li class="nav-item">
                                <a class="nav-link active" href="#{{(!empty($store))?$store->id:$store->id}}"
                                    data-toggle="tab" role="tab"
                                    aria-controls="{{(!empty($store))?$store->id:$store->id}}">{{$store->name}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </header>
                    <!-- .section-header -->
                    <div class="tab-content">
                        @foreach($stores as $store)
                        <div role="tabpanel" class="tab-pane active" id="{{(!empty($store))?$store->id:$store->id}}">
                            <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                                data-wrap=".products"
                                data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                                <div class="container-fluid">
                                    <div class="woocommerce">
                                        <div class="products">
                                            @foreach($store->products as $product)
                                            <div class="product">
                                                <div class="yith-wcwl-add-to-wishlist">
                                                    <a class='add_to_wishlist'
                                                            @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}'
                                                            @endauth>
                                                            </a>
                                                </div>
                                                <a href="{{route('show_product',$product->slug)}}" target="_blank"
                                                    class="woocommerce-LoopProduct-link">
                                                    @if($product->available_discount())
                                                    @if($product->discount->condition != 'buy_x_and_get_y_free')
                                                    <span class="onsale">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <ins>
                                                                <span class="amount">{!! curr($product->calc_price() -
                                                                    $product->discount->price()) !!}</span>
                                                            </ins>
                                                        </span>
                                                    </span>
                                                    @endif
                                                    @endif
                                                    <img src="{{Storage::url($product->image)}}" width="224" height="197"
                                                        class="wp-post-image" alt="">
                                                    <span class="price">
                                                        @if($product->available_discount())
                                                        <ins>
                                                            <span class="amount">{!! curr($product->discount->price())
                                                                !!}</span>
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
                                                    <span
                                                        class='product_shipping'>{{$product->calc_shippings($country)}}</span>

                                                    <!-- /.price -->
                                                    <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>

                                                </a>
                                                <div class="hover-area">
                                                    @if($product->IsVariable())
                                                    <a class="button add_to_cart_button"
                                                        href='{{route('show_product', $product->slug)}}' target="_blank"
                                                        rel="nofollow">@lang('user.Add_to_cart')</a>
                                                    @if(!in_array($product->id,$compare))
                                                    <a class="add-to-compare-link comp"
                                                        wire:click='compare({{$product->id}})'
                                                        style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                                    @else
                                                    <a class="add-to-compare-link disabled"
                                                        disabled>@lang('user.already_added')</a>
                                                    @endif
                                                    @else
                                                    <a class="button product_type_simple add_to_cart_button"
                                                        wire:click='addCart({{$product->id}})' rel="nofollow"
                                                        wire:loading.class="disabled">@lang('user.Add_to_cart')
                                                        <div wire:loading>
                                                            <i class="fa fa-spinner " aria-hidden="true"></i>
                                                        </div>
                                                    </a>
                                                    @if(!in_array($product->id,$compare))
                                                    <a class="add-to-compare-link comp"
                                                        wire:click='compare({{$product->id}})'
                                                        style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                                    @else
                                                    <a class="add-to-compare-link disabled"
                                                        disabled>@lang('user.already_added')</a>
                                                    @endif
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
                            <!-- .slick-dots -->
                        </div>
                        @endforeach
                        <!-- .tab-pane -->
                    </div>
                    <!-- .tab-content -->
                </div>
                <!-- .section-products-carousel-tabs-wrap -->
            </section>
        @endif
        <!-- .section-products-carousel-tabs -->
        <section class="section-hot-new-arrivals section-products-carousel-tabs">
            <div class="section-products-carousel-tabs-wrap">
                <header class="section-header">
                    <h2 class="section-title">@lang('user.Latest_Products')</h2>
                    <ul role="tablist" class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="#top-20-2" data-toggle="tab" role="tab"
                                aria-controls="top-20-2">@lang('user.Top_20')</a>
                        </li>
                        @foreach($latest_products as $latest)
                        <li class="nav-item">
                            <a class="nav-link " href="#{{$latest->slug}}" data-toggle="tab" role="tab"
                        aria-controls="{{$latest->slug}}">{{$latest->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                </header>
                <!-- .section-header -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="top-20-2">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce">
                                    <div class="products">
                                        @foreach($products as $product)
                                    <div class="product">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <a class='add_to_wishlist'
                                                        @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}'
                                                        @endauth>
                                                        </a>
                                        </div>
                                        <a href="{{route('show_product', $product->slug)}}" target="_blank" class="woocommerce-LoopProduct-link">
                                            <img src="{{Storage::url($product->image)}}"
                                             style="height:197px;width:224px;" class="wp-post-image" alt="" >
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
                                            <span class='product_shipping'>{{$product->calc_shippings($country)}}</span>

                                            <!-- /.price -->
                                            <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>
                                        </a>
                                        <div class="hover-area">
                                            @if($product->IsVariable())
                                            <a class="button add_to_cart_button"
                                                href='{{route('show_product', $product->slug)}}' target="_blank" rel="nofollow">@lang('user.Add_to_cart')</a>
                                                @if($compare !== null)
                                                    @if(!in_array($product->id,$compare))
                                                    <a class="add-to-compare-link comp" wire:click='compare({{$product->id}})' style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                                    @else
                                                    <a class="add-to-compare-link disabled" disabled>@lang('user.already_added')</a>
                                                    @endif
                                                @endif
                                            @else
                                            <a class="button product_type_simple add_to_cart_button" wire:click='addCart({{$product->id}})'
                                                rel="nofollow" wire:loading.class="disabled">@lang('user.Add_to_cart')
                                                <div wire:loading>
                                                    <i class="fa fa-spinner " aria-hidden="true"></i>
                                                </div>
                                            </a>
                                                @if($compare !== null)
                                                    @if(!in_array($product->id,$compare))
                                                    <a class="add-to-compare-link comp" wire:click='compare({{$product->id}})' style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                                    @else
                                                    <a class="add-to-compare-link disabled" disabled>@lang('user.already_added')</a>
                                                    @endif
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                    @foreach($latest_products as $latest)
                    <div role="tabpanel" class="tab-pane" id="{{$latest->slug}}">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce">
                                    <div class="products">
                                        @foreach($latest->products as $product)
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a class='add_to_wishlist'
                                                        @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}'
                                                        @endauth>
                                                        </a>
                                            </div>
                                            <a href="{{route('show_product',$product->slug)}}" target="_blank"
                                                class="woocommerce-LoopProduct-link">
                                                @if($product->available_discount())
                                                @if($product->discount->condition != 'buy_x_and_get_y_free')
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <ins>
                                                            <span class="amount">{!! curr($product->calc_price() -
                                                                $product->discount->price()) !!}</span>
                                                        </ins>
                                                    </span>
                                                </span>
                                                @endif
                                                @endif
                                                <img src="{{Storage::url($product->image)}}" width="224" height="197"
                                                    class="wp-post-image" alt="">
                                                <span class="price">
                                                    @if($product->available_discount())
                                                    <ins>
                                                        <span class="amount">{!! curr($product->discount->price())
                                                            !!}</span>
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
                                                <span
                                                    class='product_shipping'>{{$product->calc_shippings($country)}}</span>

                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>

                                            </a>
                                            <div class="hover-area">
                                                @if($product->IsVariable())
                                                <a class="button add_to_cart_button"
                                                    href='{{route('show_product', $product->slug)}}' target="_blank"
                                                    rel="nofollow">@lang('user.Add_to_cart')</a>
                                                @if(!in_array($product->id,$compare))
                                                <a class="add-to-compare-link comp"
                                                    wire:click='compare({{$product->id}})'
                                                    style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                                @else
                                                <a class="add-to-compare-link disabled"
                                                    disabled>@lang('user.already_added')</a>
                                                @endif
                                                @else
                                                <a class="button product_type_simple add_to_cart_button"
                                                    wire:click='addCart({{$product->id}})' rel="nofollow"
                                                    wire:loading.class="disabled">@lang('user.Add_to_cart')
                                                    <div wire:loading>
                                                        <i class="fa fa-spinner " aria-hidden="true"></i>
                                                    </div>
                                                </a>
                                                @if(!in_array($product->id,$compare))
                                                <a class="add-to-compare-link comp"
                                                    wire:click='compare({{$product->id}})'
                                                    style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                                @else
                                                <a class="add-to-compare-link disabled"
                                                    disabled>@lang('user.already_added')</a>
                                                @endif
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
                        <!-- .slick-dots -->
                    </div>
                    @endforeach
                    <!-- .tab-pane -->
                </div>
                <!-- .tab-content -->
            </div>
            <!-- .section-products-carousel-tabs-wrap -->
        </section>
        <!-- .section-products-carousel-tabs -->
    </div>
    <!-- .products-carousel-tabs-block -->
</div>
