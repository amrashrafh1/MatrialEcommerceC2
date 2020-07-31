<div class="row section-products-carousel-widget-with-tabs" id="carousel-widget-with-tabs">
    <div class="landscape-products-widget-block">
        <section class="section-landscape-products-widget-carousel type-2" id="section-products-carousel-widgets">
            <header class="section-header">
                <h2 class="section-title">@lang('user.Hand_picked_for_you')</h2>
                <nav class="custom-slick-nav"></nav>
            </header>
            <!-- .section-header -->
            <div class="products-carousel hand-picked-carousel" data-ride="tm-slick-carousel" data-wrap=".products"
                data-slick="{&quot;rows&quot;:6,&quot;slidesPerRow&quot;:2,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#section-products-carousel-widgets .custom-slick-nav&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:480,&quot;settings&quot;:{&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:750,&quot;settings&quot;:{&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:1190,&quot;settings&quot;:{&quot;rows&quot;:8,&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesPerRow&quot;:1,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}}]}">
                <div class="container-fluid">
                    <div class="woocommerce columns-1">
                        <div class="products">
                            @foreach($handpicked as $product)
                            <div class="landscape-product-widget product">
                                <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                    <div class="media">
                                        <img class="wp-post-image"
                                            src="{{ url('/') }}/FrontEnd/images/products/sm-1.jpg" alt="">
                                        <div class="media-body">
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
        <section class="section-hot-new-arrivals section-products-carousel-tabs">
            <div class="section-products-carousel-tabs-wrap">
                <header class="section-header">
                    <h2 class="section-title">CES 2017 Arrivals</h2>
                    <ul role="tablist" class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="#top-20" data-toggle="tab" role="tab"
                                aria-controls="top-20">Top 20</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#audio-video" data-toggle="tab" role="tab"
                                aria-controls="audio-video">Audio &amp; Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#laptops-computers" data-toggle="tab" role="tab"
                                aria-controls="laptops-computers">Laptops &amp; Computers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#video-cameras" data-toggle="tab" role="tab"
                                aria-controls="video-cameras">Video Cameras</a>
                        </li>
                    </ul>
                </header>
                <!-- .section-header -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="top-20">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                    <div role="tabpanel" class="tab-pane" id="audio-video">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                    <div role="tabpanel" class="tab-pane" id="laptops-computers">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                    <div role="tabpanel" class="tab-pane" id="video-cameras">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                </div>
                <!-- .tab-content -->
            </div>
            <!-- .section-products-carousel-tabs-wrap -->
        </section>
        <!-- .section-products-carousel-tabs -->
        <section class="section-hot-new-arrivals section-products-carousel-tabs">
            <div class="section-products-carousel-tabs-wrap">
                <header class="section-header">
                    <h2 class="section-title">Video Cameras</h2>
                    <ul role="tablist" class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="#top-20-2" data-toggle="tab" role="tab"
                                aria-controls="top-20-2">Top 20</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#audio-video-2" data-toggle="tab" role="tab"
                                aria-controls="audio-video-2">Audio &amp; Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#laptops-computers-2" data-toggle="tab" role="tab"
                                aria-controls="laptops-computers-2">Laptops &amp; Computers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#video-cameras-2" data-toggle="tab" role="tab"
                                aria-controls="video-cameras-2">Video Cameras</a>
                        </li>
                    </ul>
                </header>
                <!-- .section-header -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="top-20-2">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                    <div role="tabpanel" class="tab-pane" id="audio-video-2">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                    <div role="tabpanel" class="tab-pane" id="laptops-computers-2">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
                    <!-- .tab-pane -->
                    <div role="tabpanel" class="tab-pane" id="video-cameras-2">
                        <div class="products-carousel 5-column-carousel" data-ride="tm-slick-carousel"
                            data-wrap=".products"
                            data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5,&quot;dots&quot;:true,&quot;arrows&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1000,&quot;settings&quot;:{&quot;slidesToShow&quot;:2,&quot;slidesToScroll&quot;:2}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}}]}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-5">
                                    <div class="products">
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Drone WIFI FPV With 4K</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">4K Action Cam with Wi-Fi &
                                                    GPS</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 399.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">XONE Wireless Controller
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bbd 23-Inch Screen LED-Lit
                                                    Monitorss Buds</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Xtreme ultimate splashproof
                                                    portable speaker</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Video & Air Quality Monitor
                                                </h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 262.81</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">459.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">ZenBook 3 Ultrabook 8GB
                                                    512SSD W10</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">On-ear Wireless NXTG</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Gear Virtual Reality 3D with
                                                    Bluetooth Glasses</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> </span>
                                                    </ins>
                                                    <span class="amount"> 456.00</span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Watch Stainless with Grey
                                                    Suture Leather Strap</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 262.81</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">399.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Band Fitbit Flex</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                        <div class="product">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to
                                                    Wishlist</a>
                                            </div>
                                            <a href="single-product-fullwidth.html"
                                                class="woocommerce-LoopProduct-link">
                                                <span class="onsale">
                                                    <span class="woocommerce-Price-amount amount">
                                                        <span
                                                            class="woocommerce-Price-currencySymbol">$</span>150.04</span>
                                                </span>
                                                <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" width="224"
                                                    height="197" class="wp-post-image" alt="">
                                                <span class="price">
                                                    <ins>
                                                        <span class="amount"> 789.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">999.00</span>
                                                    </del>
                                                    <span class="amount"> </span>
                                                </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Bluetooth on-ear PureBass
                                                    Headphones</h2>
                                            </a>
                                            <div class="hover-area">
                                                <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add
                                                    to cart</a>
                                                <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            </div>
                                        </div>
                                        <!-- /.product-outer -->
                                    </div>
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .slick-dots -->
                    </div>
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
