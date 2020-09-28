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
                                            <a style="position: absolute;{{$direction == 'right'?'left':'right'}}: 0;top: 0;cursor:pointer;" @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}' @endauth>
                                                <i class="fa fa-heart-o fa-2x wish @auth
                                                @if($wishlist_product_id->contains($product->id)) change_color
                                                @endif
                                                @endauth"></i>
                                           </a>
                                        </div>
                                        <a href="{{route('show_product', $product->slug)}}" class="woocommerce-LoopProduct-link">
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
                                            <span class='product_shipping'>{{product_shipping($product)}}</span>

                                            <!-- /.price -->
                                            <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>
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
                                            <a style="position: absolute;{{$direction == 'right'?'left':'right'}}: 0;top: 0;cursor:pointer;" @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}' @endauth>
                                                <i class="fa fa-heart-o fa-2x wish @auth
                                                @if($wishlist_product_id->contains($product->id)) change_color
                                                @endif
                                                @endauth"></i>
                                           </a>
                                        </div>
                                        <a href="{{route('show_product', $product->slug)}}" class="woocommerce-LoopProduct-link">
                                            <img src="{{Storage::url($product->image)}}"
                                             style="height:197px;width:224px;" class="wp-post-image" alt="">
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
                                            <span class='product_shipping'>{{product_shipping($product)}}</span>

                                            <!-- /.price -->
                                            <h2 class="woocommerce-loop-product__title">{!! $product->name !!}</h2>
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
