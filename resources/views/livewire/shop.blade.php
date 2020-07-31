<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.Home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                <a href="{{route('shop')}}">@lang('user.Shop')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>@if(count($pros) > 0)
                {{$pros->currentPage()}}
                @else
                {{$products->currentPage()}}
                @endif
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    @if(!empty($this->category))
                    <div class="shop-archive-header" wire:ignore>
                        <div class="jumbotron">
                            <div class="jumbotron-img">
                                <img width="416" height="283" alt="" src="{{Storage::url($this->category->image)}}" class="jumbo-image alignright">
                            </div>
                            <div class="jumbotron-caption">
                                <h3 class="jumbo-title">{{$this->category->name}}</h3>
                                <p class="jumbo-subtitle">
                                    {!! $this->category->description !!}
                                </p>
                            </div>
                            <!-- .jumbotron-caption -->
                        </div>
                        <!-- .jumbotron -->
                    </div>
                    @endif
                    <!-- .shop-archive-header -->
                    <div class="shop-control-bar">
                        <div class="handheld-sidebar-toggle">
                            <button type="button" class="btn sidebar-toggler">
                                <i class="fa fa-sliders"></i>
                                <span>Filters</span>
                            </button>
                        </div>
                        <!-- .handheld-sidebar-toggle -->
                        <h1 class="woocommerce-products-header__title page-title">@lang('user.Shop')</h1>
                        <ul role="tablist" class="shop-view-switcher nav nav-tabs">
                            <li class="nav-item">
                                <a href="#grid-extended" title="Grid Extended View" data-toggle="tab" class="nav-link active">
                                    <i class="tm tm-grid"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#list-view-large" title="List View Large" data-toggle="tab" class="nav-link ">
                                    <i class="tm tm-listing-large"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#list-view" title="List View" data-toggle="tab" class="nav-link ">
                                    <i class="tm tm-listing"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#list-view-small" title="List View Small" data-toggle="tab" class="nav-link ">
                                    <i class="tm tm-listing-small"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- .shop-view-switcher -->
                        <form class="form-techmarket-wc-ppp" wire:ignore>
                            <select class="techmarket-wc-wppp-select c-select" wire:model='PerPage'>
                                <option value="20">@lang('user.Show_20')</option>
                                <option value="40">@lang('user.Show_40')</option>
                                <option value="100">@lang('user.Show_100')</option>
                            </select>
                            <input type="hidden" value="5" name="shop_columns">
                            <input type="hidden" value="15" name="shop_per_page">
                            <input type="hidden" value="right-sidebar" name="shop_layout">
                        </form>
                        <!-- .form-techmarket-wc-ppp -->
                        <form method="get" class="woocommerce-ordering" wire:ignore>
                            <select class="orderby" name="orderby" wire:model='sortBy'>
                                <option value="popularity">@lang('user.popularity')</option>
                                <option value="rating">@lang('user.Sort_by_average_rating')</option>
                                <option selected="selected" value="newness">@lang('user.Sort_by_newness')</option>
                                <option value="price-asc">@lang('user.Sort_by_price:_low_to_high')</option>
                                <option value="price-desc">@lang('user.Sort_by_price:_high_to_low')</option>
                            </select>
                            <input type="hidden" value="5" name="shop_columns">
                            <input type="hidden" value="15" name="shop_per_page">
                            <input type="hidden" value="right-sidebar" name="shop_layout">
                        </form>
                        <!-- .woocommerce-ordering -->
                        @if(count($pros) > 0)
                        <nav class="techmarket-advanced-pagination">
                            <div class="form-adv-pagination">
                                <input type="number" wire:model='PageNumber' name="goTo"
                                value="{{$pros->currentPage()}}"
                                required class="form-control" step="1" max="{{$pros->lastPage()}}" min="1" id="goto-page">
                            </div> of {{$pros->lastPage()}}<a href="#" class="next page-numbers">→</a>
                        </nav>
                        @else
                        <nav class="techmarket-advanced-pagination">
                            <div class="form-adv-pagination">

                                <input type="number" wire:model='PageNumber' name="goTo"
                                value="{{$products->currentPage()}}"
                                required class="form-control" step="1" max="{{$products->lastPage()}}" min="1" size="2" id="goto-page">
                            </div> of {{$products->lastPage()}}<a href="#" class="next page-numbers">→</a>
                        </nav>
                        @endif
                        <!-- .techmarket-advanced-pagination -->
                    </div>
                    <!-- .shop-control-bar -->
                    <div class="tab-content">
                        <!-- .tab-pane -->
                        <div id="grid-extended" class="tab-pane active" role="tabpanel">
                            <div class="woocommerce columns-4">
                                <div class="products">
                                    @php
                                        $count = 1;
                                    @endphp
                                    @if(count($pros) > 0)
                                    @foreach($pros as $product)
                                    <div class="product {{($count%4 == 1)?'first':''}} {{($count%4 == 0)?'last':''}}">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                        </div>
                                        <!-- .yith-wcwl-add-to-wishlist -->
                                        <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="{{route('show_product', $product->slug)}}">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="{{Storage::url($product->image)}}">
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
                                            <h2 class="woocommerce-loop-product__title">{{ $product->name }}</h2>
                                        </a>
                                        <!-- .woocommerce-LoopProduct-link -->
                                        <div class="techmarket-product-rating">
                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                <span style="width:{{$product->averageRating(null, true)[0] * 2 * 10}}%">
                                                    <strong class="rating">5.00</strong> out of 5</span>
                                            </div>
                                            <span class="review-count">({{DB::table('reviews')
                                                ->where('reviewrateable_id', $product->id)->where('approved', 1)
                                                ->count()}})</span>
                                        </div>
                                        <!-- .techmarket-product-rating -->
                                        <span class="sku_wrapper">@lang('user.SKU:')
                                            <span class="sku">{{$product->sku}}</span>
                                        </span>
                                        <div class="woocommerce-product-details__short-description">
                                            {!! $product->short_description !!}
                                        </div>
                                        <!-- .woocommerce-product-details__short-description -->
                                        @if($product->IsVariable())
                                            <a class="button product_type_simple add_to_cart_button" href='{{route('show_product',$product->slug)}}'
                                                rel="nofollow">Add to cart</a>
                                            <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            @else
                                            <a class="button product_type_simple add_to_cart_button" wire:click='addCart({{$product->id}})'
                                                rel="nofollow">Add to cart</a>
                                            <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            @endif
                                    </div>
                                    @php $count++; @endphp
                                    @endforeach
                                    @else
                                    @foreach($products as $product)
                                    <div class="product {{($count%4 == 1)?'first':''}} {{($count%4 == 0)?'last':''}}">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                        </div>
                                        <!-- .yith-wcwl-add-to-wishlist -->
                                        <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="{{route('show_product', $product->slug)}}">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="{{Storage::url($product->image)}}">
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
                                            <h2 class="woocommerce-loop-product__title">{{ $product->name }}</h2>
                                        </a>
                                        <!-- .woocommerce-LoopProduct-link -->
                                        <div class="techmarket-product-rating">
                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                <span style="width:{{$product->averageRating(null, true)[0] * 2 * 10}}%">
                                                    <strong class="rating">5.00</strong> out of 5</span>
                                            </div>
                                            <span class="review-count">({{DB::table('reviews')
                                                ->where('reviewrateable_id', $product->id)->where('approved', 1)
                                                ->count()}})</span>
                                        </div>
                                        <!-- .techmarket-product-rating -->
                                        <span class="sku_wrapper">@lang('user.SKU:')
                                            <span class="sku">{{$product->sku}}</span>
                                        </span>
                                        <div class="woocommerce-product-details__short-description">
                                            {!! $product->short_description !!}
                                        </div>
                                        <!-- .woocommerce-product-details__short-description -->
                                        @if($product->IsVariable())
                                            <a class="button product_type_simple add_to_cart_button" href='{{route('show_product',$product->slug)}}'
                                                rel="nofollow">Add to cart</a>
                                            <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            @else
                                            <a class="button product_type_simple add_to_cart_button" wire:click='addCart({{$product->id}})'
                                                rel="nofollow">Add to cart</a>
                                            <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                            @endif
                                    </div>
                                    @php $count++; @endphp
                                    @endforeach
                                    @endif
                                    <!-- .product -->
                                </div>
                                <!-- .products -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .tab-pane -->
                        <div id="list-view-large" class="tab-pane" role="tabpanel">
                            <div class="woocommerce columns-1">
                                <div class="products">
                                    <div class="product list-view-large first ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-large ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/2.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-large ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/3.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-large last">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/4.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-large first ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-large ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/6.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                    <span class="sku_wrapper">SKU:
                                                        <span class="sku">5487FB8/13</span>
                                                    </span>
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                </div>
                                <!-- .products -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .tab-pane -->
                        <div id="list-view" class="tab-pane" role="tabpanel">
                            <div class="woocommerce columns-1">
                                <div class="products">
                                    <div class="product list-view ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view last">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/2.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view first ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/3.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/4.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view last">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/6.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="brand">
                                                        <a href="#">
                                                            <img alt="galaxy" src="assets/images/brands/5.png">
                                                        </a>
                                                    </div>
                                                    <!-- .brand -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <div class="availability">
                                                        Availability:
                                                        <p class="stock in-stock">1000 in stock</p>
                                                    </div>
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                </div>
                                <!-- .products -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .tab-pane -->
                        <div id="list-view-small" class="tab-pane" role="tabpanel">
                            <div class="woocommerce columns-1">
                                <div class="products">
                                    <div class="product list-view-small first ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/1.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/2.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/3.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small last">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/4.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small first ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/5.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/6.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/7.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small last">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/8.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                    <div class="product list-view-small first ">
                                        <div class="media">
                                            <img width="224" height="197" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="assets/images/products/9.jpg">
                                            <div class="media-body">
                                                <div class="product-info">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a href="wishlist.html" rel="nofollow" class="add_to_wishlist"> Add to Wishlist</a>
                                                    </div>
                                                    <!-- .yith-wcwl-add-to-wishlist -->
                                                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                        <h2 class="woocommerce-loop-product__title">60UH6150 60-Inch 4K Ultra HD Smart LED TV</h2>
                                                        <div class="techmarket-product-rating">
                                                            <div title="Rated 5.00 out of 5" class="star-rating">
                                                                <span style="width:100%">
                                                                    <strong class="rating">5.00</strong> out of 5</span>
                                                            </div>
                                                            <span class="review-count">(1)</span>
                                                        </div>
                                                    </a>
                                                    <!-- .woocommerce-LoopProduct-link -->
                                                    <div class="woocommerce-product-details__short-description">
                                                        <ul>
                                                            <li>CUJO smart firewall brings business-level Internet security to protect all of your home devices</li>
                                                            <li>Internet Security: Guard your network and smart devices against hacks, malware, and cyber threats</li>
                                                            <li>Mobile App: Monitor your wired and wireless network activity with a sleek iPhone or Android app</li>
                                                            <li>CUJO connects to your wireless router with an ethernet cable. CUJO is not compatible with Luma and does not support Google Wifi Mesh. CUJO works with Eero in Bridge mode.</li>
                                                        </ul>
                                                    </div>
                                                    <!-- .woocommerce-product-details__short-description -->
                                                </div>
                                                <!-- .product-info -->
                                                <div class="product-actions">
                                                    <span class="price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            <span class="woocommerce-Price-currencySymbol">$</span>730.00</span>
                                                    </span>
                                                    <!-- .price -->
                                                    <a class="button add_to_cart_button" href="cart.html">Add to Cart</a>
                                                    <a class="add-to-compare-link" href="compare.html">Add to compare</a>
                                                </div>
                                                <!-- .product-actions -->
                                            </div>
                                            <!-- .media-body -->
                                        </div>
                                        <!-- .media -->
                                    </div>
                                    <!-- .product -->
                                </div>
                                <!-- .products -->
                            </div>
                            <!-- .woocommerce -->
                        </div>
                        <!-- .tab-pane -->
                    </div>
                    <!-- .tab-content -->
                    <div class="shop-control-bar-bottom">
                        <form class="form-techmarket-wc-ppp" method="POST">
                            <select class="techmarket-wc-wppp-select c-select" wire:model='PerPage'>
                                <option value="20">@lang('user.Show_20')</option>
                                <option value="40">@lang('user.Show_40')</option>
                                <option value="100">@lang('user.Show_100')</option>
                            </select>
                            <input type="hidden" value="5" name="shop_columns">
                            <input type="hidden" value="15" name="shop_per_page">
                            <input type="hidden" value="right-sidebar" name="shop_layout">
                        </form>
                        <!-- .form-techmarket-wc-ppp -->
                        <p class="woocommerce-result-count">
                            @if(count($pros) > 0)
                            Showing {{$pros->firstItem()}}&ndash;{{$pros->lastItem()}} of {{$pros->total()}} results
                            @else
                            Showing {{$products->firstItem()}}&ndash;{{$products->lastItem()}} of {{$products->total()}} results
                            @endif
                        </p>
                        <!-- .woocommerce-result-count -->
                        <nav class="woocommerce-pagination">
                            @if(count($pros) > 0)

                            {{ $pros->links() }}
                            @else
                            {{ $products->links() }}
                            @endif
                        </nav>
                        <!-- .woocommerce-pagination -->
                    </div>
                    <!-- .shop-control-bar-bottom -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
            <div id="secondary" class="widget-area shop-sidebar" role="complementary" wire:ignore>
                <div class="widget woocommerce widget_product_categories techmarket_widget_product_categories" id="techmarket_product_categories_widget-2">
                    <ul class="product-categories ">
                        <li class="product_cat">
                            <span>@lang('user.Browse_Categories')</span>
                            <ul>
                                @foreach($categories as $category)
                                <li class="cat-item">
                                    <a href="{{route('show_category', $category->slug)}}">
                                        <span class="{{(count($category->children) > 0)?'child-indicator':'no-child'}}"></span>{{$category->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </div>
                <div id="techmarket_products_filter-3" class="widget widget_techmarket_products_filter">
                    {{-- <span class="gamma widget-title">Filters</span>
                    <div class="widget woocommerce widget_price_filter" id="woocommerce_price_filter-2">
                        <p>
                            <span class="gamma widget-title">Filter by price</span>
                            <div class="price_slider_amount">
                                <input id="amount" type="text" placeholder="Min price" data-min="6" value="33" name="min_price" style="display: none;">
                                <button class="button" type="submit">Filter</button>
                            </div>
                            <div id="slider-range" class="price_slider"></div>
                    </div> --}}
                    <div class="widget woocommerce widget_layered_nav maxlist-more" id="woocommerce_layered_nav-2" wire:ignore>
                        <span class="gamma widget-title">@lang('user.Brands')</span>
                        <ul>

                            @foreach($brands as $brand)
                            <div class="custom-control custom-radio custom-control-block mb-2">
                                <input type="radio" class="custom-control-input"
                                wire:model='assId' value="{{$brand->id}}" id="customRadio{{$brand->id}}">
                            <label class="custom-control-label" for="customRadio{{$brand->id}}">
                                {{$brand->name}} ({{$brand->products->where('visible', 'visible')->where('approved', 1)->count()}})
                            </label>
                            </div>
                            @endforeach
                        </ul>
                    </div>
                    <!-- .woocommerce widget_layered_nav -->
                    <div class="widget woocommerce widget_layered_nav maxlist-more" id="woocommerce_layered_nav-3" wire:ignore>
                        @foreach($family as $fam)
                        <span class="gamma widget-title">{{$fam->name}}</span>
                        <ul>
                            @foreach($fam->attributes()->whereIn('id',$attributes->pluck('id'))->get() as $attribute)
                            <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" wire:model='ass_attrs'
                            name="attributes[]" value="{{$attribute->id}}" id="customCheck{{$attribute->id}}">
                                <label class="custom-control-label" for="customCheck{{$attribute->id}}">{{$attribute->name}}</label>
                            </div>
                            @endforeach
                        </ul>
                        @endforeach
                    </div>
                    <!-- .woocommerce widget_layered_nav -->
                </div>
                <div class="widget widget_techmarket_products_carousel_widget" wire:ignore>
                    <section id="single-sidebar-carousel" class="section-products-carousel">
                        <header class="section-header">
                            <h2 class="section-title">@lang('user.Latest_Products')</h2>
                            <nav class="custom-slick-nav"></nav>
                        </header>
                        <!-- .section-header -->
                        <div class="products-carousel" data-ride="tm-slick-carousel" data-wrap=".products" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;rows&quot;:2,&quot;slidesPerRow&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-left\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-right\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;appendArrows&quot;:&quot;#single-sidebar-carousel .custom-slick-nav&quot;}">
                            <div class="container-fluid">
                                <div class="woocommerce columns-1">
                                    <div class="products">
                                        @foreach(\App\Product::orderBy('id', 'DESC')->take(10)->get() as $latest)
                                        <div class="landscape-product-widget product">
                                            <a class="woocommerce-LoopProduct-link" href="{{route('show_product', $latest->slug)}}">
                                                <div class="media">
                                                    <img class="wp-post-image" src="{{Storage::url($latest->image)}}" alt="">
                                                    <div class="media-body">
                                                        <span class="price">
                                                            @if(isset($latest->discount))
                                                            <ins>
                                                                <span class="amount">{!! curr($latest->priceDiscount()) !!}</span>
                                                            </ins>
                                                            <del>
                                                                <span class="amount">{!! curr($latest->sale_price) !!}</span>
                                                            </del>
                                                            @else
                                                            <ins>
                                                                <span class="amount">{!! curr($latest->sale_price) !!}</span>
                                                            </ins>
                                                            @endif
                                                        </span>
                                                        <!-- .price -->
                                                        <h2 class="woocommerce-loop-product__title">{{$latest->name}}</h2>
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
                                    <!-- .products -->
                                </div>
                                <!-- .woocommerce -->
                            </div>
                            <!-- .container-fluid -->
                        </div>
                        <!-- .products-carousel -->
                    </section>
                    <!-- .section-products-carousel -->
                </div>
                <!-- .widget_techmarket_products_carousel_widget -->
            </div>
        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>

