<div wire:ignore>
    <div>
        <section class="section-3-2-3-product-cards-tabs-with-featured-product stretch-full-width">
            <div class="col-full">
                <header class="section-header">
                    <h2 class="section-title">@lang('user.Hurry_up!')
                        <span> @lang('user.Special_Offers')</span>
                    </h2>
                    <ul role="tablist" class="nav justify-content-center">
                        @foreach($categories as $index => $category)
                        @if(!empty($category->products))
                        <li class="nav-item"><a class="nav-link {{($index == 0)?'active':''}}" href="#tabs{{$category->id}}" data-toggle="tab">{!!$category->name!!}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </header>
                <!-- .section-header -->
                <div class="tab-content">
                    @foreach($categories as $index => $category)
                    <div id="tabs{{$category->id}}" class="tab-pane {{($index == 0)?'active':''}}" role="tabpanel">
                        <div class="product-cards-3-2-3-with-featured-product">
                            <div class="row">
                                <div class="products-3">
                                    <div class="woocommerce columns-1">
                                        <div class="products">
                                            @foreach($category->products->take(3) as $product)
                                            <div class="landscape-product-card product">
                                                <div class="media">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a style="position: absolute;right: 0;top: 0;cursor:pointer;" @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}' @endauth>
                                                            <i class="fa fa-heart-o fa-2x wish @auth
                                                            @if($wishlist_product_id->contains($product->id)) change_color
                                                            @endif
                                                            @endauth"></i>
                                                       </a>                                                      </div>
                                                    <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                                    <img class="wp-post-image" src="{{Storage::url($product->image)}}" alt="{!!$product->name!!}">
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="woocommerce-LoopProduct-link " href="single-product-fullwidth.html">

                                                                    <span class="price">
                                                                        <ins>
                                                                            <span class="amount"> {!! curr($product->priceDiscount()) !!}</span>
                                                                        </ins>
                                                                        <del>
                                                                            <span class="amount"> {!! curr($product->calc_price()) !!}</span>
                                                                        </del>
                                                                    </span>
                                                            <!-- .price -->
                                                            <h2 class="woocommerce-loop-product__title">{!!$product->name!!}</h2>
                                                            <div class="ribbon green-label">
                                                                <span>A+</span>
                                                            </div>
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
                                                        </a>
                                                        <div class="hover-area">
                                                            @if($product->IsVariable())
                                                            <a class="button add_to_cart_button"
                                                                href='{{route('show_product', $product->slug)}}' rel="nofollow">@lang('user.Add_to_cart')</a>
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
                                                        <!-- .hover-area -->
                                                    </div>
                                                    <!-- .media-body -->
                                                </div>
                                                <!-- .media -->
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="products-3-with-featured">
                                    <div class="woocommerce columns-1">
                                        <div class="products">
                                            @foreach($category->products->skip(3)->take(1) as $product)
                                            <div class="landscape-product-card-featured product">
                                                <div class="media">
                                                    <div class="techmarket-product-gallery images techmarket-3-2-3-gallery">
                                                        <figure class="techmarket-wc-product-gallery__wrapper" data-ride="tm-slick-carousel" data-wrap=".techmarket-wc-product-gallery__wrapper" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:false,&quot;asNavFor&quot;:&quot;.techmarket-3-2-3-gallery .techmarket-wc-product-gallery-thumbnails__wrapper&quot;}">
                                                            @foreach($product->gallery as $image)
                                                            <figure class="techmarket-wc-product-gallery__image" data-thumb="{{Storage::url($image->file)}}">
                                                                <img width="600" height="600" title="" alt="" class="wp-post-image1" src="{{Storage::url($image->file)}}">
                                                            </figure>
                                                            @endforeach

                                                        </figure>
                                                        <figure class="techmarket-wc-product-gallery-thumbnails__wrapper" data-ride="tm-slick-carousel" data-wrap=".techmarket-wc-product-gallery-thumbnails__wrapper" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;vertical&quot;:true,&quot;verticalSwiping&quot;:true,&quot;focusOnSelect&quot;:true,&quot;touchMove&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-up\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-down\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;asNavFor&quot;:&quot;.techmarket-3-2-3-gallery .techmarket-wc-product-gallery__wrapper&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:767,&quot;settings&quot;:{&quot;vertical&quot;:false,&quot;verticalSwiping&quot;:false,&quot;slidesToShow&quot;:1}}]}">
                                                            @foreach($product->gallery as $image)
                                                            <figure class="techmarket-wc-product-gallery__image">
                                                                <img width="180" height="180" title="" alt="" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="{{Storage::url($image->file)}}">
                                                            </figure>
                                                            @endforeach
                                                        </figure>
                                                    </div>
                                                    <div class="media-body">
                                                        <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="single-product-fullwidth.html">
                                                            <span class="price">
                                                                <ins>
                                                                    <span class="amount"> {!! curr($product->priceDiscount()) !!}</span>
                                                                </ins>
                                                                <del>
                                                                    <span class="amount"> {!! curr($product->calc_price()) !!}</span>
                                                                </del>
                                                            </span>
                                                            <h2 class="woocommerce-loop-product__title">{{$product->name}}</h2>
                                                            <div class="ribbon green-label">
                                                                <span>A+</span>
                                                            </div>
                                                            <div class="techmarket-product-rating">
                                                                <div title="Rated 5.00 out of 5" class="star-rating">
                                                                    <span style="width:{{$product->averageRating(null, true)[0] * 2 * 10}}%">
                                                                        <strong class="rating">5.00</strong> out of 5</span>
                                                                </div>
                                                                <span class="review-count">({{DB::table('reviews')
                                                                            ->where('reviewrateable_id', $product->id)->where('approved', 1)
                                                                            ->count()}})</span>
                                                            </div>
                                                        </a>
                                                        <div class="woocommerce-product-details__short-description">
                                                            {!! $product->short_description !!}
                                                        </div>
                                                        @if($product->IsVariable())
                                                            <a class="button add_to_cart_button"
                                                                href='{{route('show_product', $product->slug)}}' rel="nofollow">@lang('user.Add_to_cart')</a>
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
                                            </div>
                                            @endforeach
                                            @foreach($category->products->skip(4)->take(2) as $product)
                                            <div class="landscape-product-card product">
                                                <div class="media">
                                                    <a class="woocommerce-LoopProduct-link" href="single-product-fullwidth.html">
                                                        <img class="wp-post-image" src="{{Storage::url($product->image)}}" alt="{!!$product->name!!}">
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="woocommerce-LoopProduct-link " href="single-product-fullwidth.html">
                                                                <span class="price">
                                                                    <ins>
                                                                        <span class="amount"> {!! curr($product->priceDiscount()) !!}</span>
                                                                    </ins>
                                                                    <del>
                                                                        <span class="amount">{!! curr($product->calc_price()) !!}</span>
                                                                    </del>
                                                                </span>
                                                            <!-- .price -->
                                                            <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>
                                                            <div class="ribbon green-label">
                                                                <span>A+</span>
                                                            </div>
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
                                                        </a>
                                                        <div class="hover-area">
                                                            @if($product->IsVariable())
                                                            <a class="button add_to_cart_button"
                                                                href='{{route('show_product', $product->slug)}}' rel="nofollow">Add to
                                                                cart</a>
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
                                                        <!-- .hover-area -->
                                                    </div>
                                                    <!-- .media-body -->
                                                </div>
                                                <!-- .media -->
                                            </div>
                                            @endforeach
                                            <!-- .woocommerce-LoopProduct-link -->
                                        </div>
                                    </div>
                                </div>
                                <div class="products-3">
                                    <div class="woocommerce columns-1">
                                        <div class="products">
                                            @foreach($category->products->skip(6)->take(3) as $product)
                                            <div class="landscape-product-card product">
                                                <div class="media">
                                                    <div class="yith-wcwl-add-to-wishlist">
                                                        <a style="position: absolute;right: 0;top: 0;cursor:pointer;" @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}' @endauth>
                                                            <i class="fa fa-heart-o fa-2x wish @auth
                                                            @if($wishlist_product_id->contains($product->id)) change_color
                                                            @endif
                                                            @endauth"></i>
                                                       </a>                                                      </div>
                                                    <a class="woocommerce-LoopProduct-link" href="{{route('show_product',$product->slug)}}">
                                                        <img class="wp-post-image" src="{{Storage::url($product->image)}}" alt="{!!$product->name!!}">
                                                    </a>
                                                    <div class="media-body">
                                                        <a class="woocommerce-LoopProduct-link " href="{{route('show_product',$product->slug)}}">
                                                                <span class="price">
                                                                    <ins>
                                                                        <span class="amount"> {!! curr($product->priceDiscount()) !!}</span>
                                                                    </ins>
                                                                    <del>
                                                                        <span class="amount">{!! curr($product->calc_price()) !!}</span>
                                                                    </del>
                                                                </span>
                                                            <!-- .price -->
                                                            <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>
                                                            <div class="ribbon green-label">
                                                                <span>A+</span>
                                                            </div>
                                                            <div class="techmarket-product-rating">
                                                                <div title="Rated 0 out of 5" class="star-rating">
                                                                            <span style="width:0%">
                                                                                <strong class="rating">0</strong> out of 5</span>
                                                                </div>
                                                                <span class="review-count">(0)</span>
                                                            </div>
                                                            <!-- .techmarket-product-rating -->
                                                        </a>
                                                        <div class="hover-area">
                                                            @if($product->IsVariable())
                                                            <a class="button add_to_cart_button"
                                                                href='{{route('show_product', $product->slug)}}' rel="nofollow">Add to
                                                                cart</a>
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
                                                        <!-- .hover-area -->
                                                    </div>
                                                    <!-- .media-body -->
                                                </div>
                                                <!-- .media -->
                                            </div>
                                            <!-- .woocommerce-LoopProduct-link -->
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <!-- .products -->
                </div>
                <!-- .tab-content -->
            </div>
            <!-- .col-full -->
        </section>
        </div>
    </div>
