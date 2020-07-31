<div>
<!-- .section-top-categories -->
<section class="section-6-1-6-products-tabs">
    <header class="section-header">
        <h2 class="section-title">@lang('user.daily_deals!')
            <span>@lang('user.get_our_best_prices')</span>
        </h2>
    </header>
    <!-- /.section-header -->
    <div class="6-1-6-products-tabs">
        <ul role="tablist" class="nav justify-content-center">
            <li class="nav-item"><a class="nav-link " href="#tab-30" data-toggle="tab">-30%</a></li>
            <li class="nav-item"><a class="nav-link active" href="#tab-50" data-toggle="tab">-50%</a></li>
            <li class="nav-item"><a class="nav-link " href="#tab-70" data-toggle="tab">-70%</a></li>
        </ul>
        <!-- /.nav -->
        <div class="tab-content">
            <div id="tab-30" class="tab-pane" role="tabpanel">
                <div class="row row-6-1-6-products">
                    <div class="product-1">
                        <div class="woocommerce columns-1">
                            <div class="products">
                                <div class="sale-product-with-timer product">
                                    <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                        <div class="sale-product-with-timer-header">
                                            <div class="price-and-title">
                                                        <span class="price">
                                                            <ins>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>425.89</span>
                                                            </ins>
                                                            <del>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>545.89</span>
                                                            </del>
                                                        </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Tablet Red EliteBook Revolve</h2>
                                            </div>
                                            <!-- /.price-and-title -->
                                            <div class="sale-label-outer">
                                                <div class="sale-saved-label">
                                                    <span class="saved-label-text">Save</span>
                                                    <span class="saved-label-amount">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>120.00</span>
                                                            </span>
                                                </div>
                                                <!-- /.sale-saved-label -->
                                            </div>
                                            <!-- /.sale-label-outer -->
                                        </div>
                                        <!-- /.sale-product-with-timer-header -->
                                        <img width="224" height="197" alt="" class="wp-post-image" src="{{ url('/') }}/FrontEnd/images/products/6-1-6-center.jpg">
                                        <div class="deal-progress">
                                            <div class="deal-stock">
                                                <div class="stock-sold">Already Sold:
                                                    <strong>0</strong>
                                                </div>
                                                <div class="stock-available">Available:
                                                    <strong>1000</strong>
                                                </div>
                                            </div>
                                            <!-- /.deal-stock -->
                                            <div class="progress">
                                                <span style="width:0%" class="progress-bar">0</span>
                                            </div>
                                            <!-- /.progress -->
                                        </div>
                                        <!-- /.deal-progress -->
                                        <div class="deal-countdown-timer">
                                            <div class="marketing-text">
                                                <span class="line-1">Hurry up!</span>
                                                <span class="line-2">Offers ends in:</span>
                                            </div>
                                            <!-- /.marketing-text -->
                                            <span style="display:none;" class="deal-time-diff">29994</span>
                                            <div class="deal-countdown countdown"></div>
                                        </div>
                                        <!-- /.deal-countdown-timer -->
                                    </a>
                                    <!-- /.woocommerce-LoopProduct-link -->
                                </div>
                                <!-- /.sale-product-with-timer -->
                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.woocommerce -->
                    </div>
                    <!-- /.product-1 -->
                    <div class="products-6">
                        <div class="woocommerce columns-3">
                            <div class="products">
                                @foreach($discountProducts as $product)
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> {{currency($product->priceAfterDiscount, 'USD', currency()->getUserCurrency())}}</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                @endforeach
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/2.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                            </div>
                        </div>
                    </div>
                    <!-- /.product-6 -->
                    <div class="products-6">
                        <div class="woocommerce columns-3">
                            <div class="products">
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/8.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/9.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                            </div>
                        </div>
                    </div>
                    <!-- /.product-6 -->
                </div>
                <!-- /.product-1 -->
            </div>
            <!-- /.tab-pane -->
            <div id="tab-50" class="tab-pane active" role="tabpanel">
                <div class="row row-6-1-6-products">
                    <div class="product-1">
                        <div class="woocommerce columns-1">
                            <div class="products">
                                <div class="sale-product-with-timer product">
                                    <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                        <div class="sale-product-with-timer-header">
                                            <div class="price-and-title">
                                                        <span class="price">
                                                            <ins>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>425.89</span>
                                                            </ins>
                                                            <del>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>545.89</span>
                                                            </del>
                                                        </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Tablet Red EliteBook Revolve</h2>
                                            </div>
                                            <!-- /.price-and-title -->
                                            <div class="sale-label-outer">
                                                <div class="sale-saved-label">
                                                    <span class="saved-label-text">Save</span>
                                                    <span class="saved-label-amount">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>120.00</span>
                                                            </span>
                                                </div>
                                                <!-- /.sale-saved-label -->
                                            </div>
                                            <!-- /.sale-label-outer -->
                                        </div>
                                        <!-- /.sale-product-with-timer-header -->
                                        <img width="224" height="197" alt="" class="wp-post-image" src="{{ url('/') }}/FrontEnd/images/products/6-1-6-center.jpg">
                                        <div class="deal-progress">
                                            <div class="deal-stock">
                                                <div class="stock-sold">Already Sold:
                                                    <strong>0</strong>
                                                </div>
                                                <div class="stock-available">Available:
                                                    <strong>1000</strong>
                                                </div>
                                            </div>
                                            <!-- /.deal-stock -->
                                            <div class="progress">
                                                <span style="width:0%" class="progress-bar">0</span>
                                            </div>
                                            <!-- /.progress -->
                                        </div>
                                        <!-- /.deal-progress -->
                                        <div class="deal-countdown-timer">
                                            <div class="marketing-text">
                                                <span class="line-1">Hurry up!</span>
                                                <span class="line-2">Offers ends in:</span>
                                            </div>
                                            <!-- /.marketing-text -->
                                            <span style="display:none;" class="deal-time-diff">29994</span>
                                            <div class="deal-countdown countdown"></div>
                                        </div>
                                        <!-- /.deal-countdown-timer -->
                                    </a>
                                    <!-- /.woocommerce-LoopProduct-link -->
                                </div>
                                <!-- /.sale-product-with-timer -->
                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.woocommerce -->
                    </div>
                    <!-- /.product-1 -->
                    <div class="products-6">
                        <div class="woocommerce columns-3">
                            <div class="products">
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                            </div>
                        </div>
                    </div>
                    <!-- /.product-6 -->
                    <div class="products-6">
                        <div class="woocommerce columns-3">
                            <div class="products">
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/16.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/13.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/4.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/17.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                            </div>
                        </div>
                    </div>
                    <!-- /.product-6 -->
                </div>
                <!-- /.product-1 -->
            </div>
            <!-- /.tab-pane -->
            <div id="tab-70" class="tab-pane" role="tabpanel">
                <div class="row row-6-1-6-products">
                    <div class="product-1">
                        <div class="woocommerce columns-1">
                            <div class="products">
                                <div class="sale-product-with-timer product">
                                    <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                        <div class="sale-product-with-timer-header">
                                            <div class="price-and-title">
                                                        <span class="price">
                                                            <ins>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>425.89</span>
                                                            </ins>
                                                            <del>
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>545.89</span>
                                                            </del>
                                                        </span>
                                                <!-- /.price -->
                                                <h2 class="woocommerce-loop-product__title">Tablet Red EliteBook Revolve</h2>
                                            </div>
                                            <!-- /.price-and-title -->
                                            <div class="sale-label-outer">
                                                <div class="sale-saved-label">
                                                    <span class="saved-label-text">Save</span>
                                                    <span class="saved-label-amount">
                                                                <span class="woocommerce-Price-amount amount">
                                                                    <span class="woocommerce-Price-currencySymbol">$</span>120.00</span>
                                                            </span>
                                                </div>
                                                <!-- /.sale-saved-label -->
                                            </div>
                                            <!-- /.sale-label-outer -->
                                        </div>
                                        <!-- /.sale-product-with-timer-header -->
                                        <img width="224" height="197" alt="" class="wp-post-image" src="{{ url('/') }}/FrontEnd/images/products/6-1-6-center.jpg">
                                        <div class="deal-progress">
                                            <div class="deal-stock">
                                                <div class="stock-sold">Already Sold:
                                                    <strong>0</strong>
                                                </div>
                                                <div class="stock-available">Available:
                                                    <strong>1000</strong>
                                                </div>
                                            </div>
                                            <!-- /.deal-stock -->
                                            <div class="progress">
                                                <span style="width:0%" class="progress-bar">0</span>
                                            </div>
                                            <!-- /.progress -->
                                        </div>
                                        <!-- /.deal-progress -->
                                        <div class="deal-countdown-timer">
                                            <div class="marketing-text">
                                                <span class="line-1">Hurry up!</span>
                                                <span class="line-2">Offers ends in:</span>
                                            </div>
                                            <!-- /.marketing-text -->
                                            <span style="display:none;" class="deal-time-diff">29994</span>
                                            <div class="deal-countdown countdown"></div>
                                        </div>
                                        <!-- /.deal-countdown-timer -->
                                    </a>
                                    <!-- /.woocommerce-LoopProduct-link -->
                                </div>
                                <!-- /.sale-product-with-timer -->
                            </div>
                            <!-- /.products -->
                        </div>
                        <!-- /.woocommerce -->
                    </div>
                    <!-- /.product-1 -->
                    <div class="products-6">
                        <div class="woocommerce columns-3">
                            <div class="products">
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/10.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/11.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/1.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/7.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                            </div>
                        </div>
                    </div>
                    <!-- /.product-6 -->
                    <div class="products-6">
                        <div class="woocommerce columns-3">
                            <div class="products">
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/12.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/14.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/3.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/15.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/5.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                                <div class="product">
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                    </div>
                                    <a href="single-product-fullwidth.html" class="woocommerce-LoopProduct-link">
                                        <img src="{{ url('/') }}/FrontEnd/images/products/6.jpg" class="wp-post-image" alt="">
                                        <span class="price">
                                                    <ins>
                                                        <span class="amount"> $309.95</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">$459.99</span>
                                                    </del>
                                                </span>
                                        <!-- /.price -->
                                        <h2 class="woocommerce-loop-product__title">Smart Watches 3 SWR50</h2>
                                    </a>
                                    <div class="hover-area">
                                        <a class="button add_to_cart_button" href="cart.html" rel="nofollow">Add to cart</a>
                                        <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                    </div>
                                </div>
                                <!-- /.product-outer -->
                            </div>
                        </div>
                    </div>
                    <!-- /.product-6 -->
                </div>
                <!-- /.product-1 -->
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
    </div>
    <!-- /.6-1-6-products-tabs -->
</section>
<!-- /.section-6-1-6-products-tabs -->
</div>
