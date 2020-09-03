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
            <!-- /.nav -->
            <div class="tab-content">
                <div id="tab-30" class="tab-pane active" role="tabpanel">
                    <div class="row row-6-1-6-products">
                        <div class="product-1">
                            @if(isset($random))
                            <div class="woocommerce columns-1">
                                <div class="products">
                                    <div class="sale-product-with-timer product">
                                        <a class="woocommerce-LoopProduct-link" href="{{url('/product/'. $random->product->slug)}}">
                                            <div class="sale-product-with-timer-header">
                                                <div class="price-and-title">
                                                            <span class="price">
                                                                <ins>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {!! curr($random->product->priceDiscount()) !!}</span>
                                                                </ins>
                                                                <del>
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {!! curr($random->product->calc_price()) !!}</span>
                                                                </del>
                                                            </span>
                                                    <!-- /.price -->
                                                    <h2 class="woocommerce-loop-product__title">{{ $random->product->name}}</h2>
                                                </div>
                                                <!-- /.price-and-title -->
                                                <div class="sale-label-outer">
                                                    <div class="sale-saved-label">
                                                        <span class="saved-label-text">Save</span>
                                                        <span class="saved-label-amount">
                                                                    <span class="woocommerce-Price-amount amount">
                                                                        {!! curr($random->product->calc_price() - $random->product->priceDiscount()) !!}</span>
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
                                                        <strong>{{$random->product->already_sold()}}</strong>
                                                    </div>
                                                    <div class="stock-available">Available:
                                                        <strong>{{$random->product->stock}}</strong>
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
                                                @php
                                                $now = Carbon\Carbon::now();
                                                @endphp
                                                <!-- /.marketing-text -->
                                                <span style="display:none;" class="deal-time-diff">{{$now->diffInSeconds($random->expire_at)}}</span>
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
                            @endif
                            <!-- /.woocommerce -->
                        </div>
                        <!-- /.product-1 -->
                        <div class="products-6">
                            <div class="woocommerce columns-3">
                                <div class="products">
                                    @foreach($discountProducts->take(6) as $discount)
                                    <div class="product">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <a style="position: absolute;right: 0;top: 0;cursor:pointer;" @auth wire:click='wishlists({{$discount->id}})' @else href='{{route('login')}}' @endauth>
                                                <i class="fa fa-heart-o fa-2x wish @auth
                                                @if($wishlist_product_id->contains($discount->id)) change_color
                                                @endif
                                                @endauth"></i>
                                           </a>                                        </div>
                                        <a href="{{url('/product/'. $discount->product->slug)}}" class="woocommerce-LoopProduct-link">
                                        <span class="onsale">
                                            <span class="woocommerce-Price-amount amount">
                                                {!! curr($discount->product->calc_price() - $discount->product->priceDiscount()) !!}</span>
                                        </span>
                                        <img src="{{Storage::url($discount->product->image)}}" class="wp-post-image" alt="{{$discount->product->name}}">
                                            <span class="price">
                                                    <ins>
                                                        <span class="amount">{!! curr($discount->product->priceDiscount()) !!}</span>
                                                    </ins>
                                                    <del>
                                                        <span class="amount">{!! curr($discount->product->calc_price()) !!}</span>
                                                    </del>
                                                </span>
                                            <!-- /.price -->
                                            <h2 class="woocommerce-loop-product__title">{{$discount->product->name}}</h2>

                                        </a>
                                        <div class="hover-area">
                                            @if($discount->product->IsVariable())
                                            <a class="button add_to_cart_button" href='{{url('/'. $product->slug)}}'
                                                rel="nofollow">@lang('user.Add_to_cart')</a>
                                                @if($compare !== null)
                                                    @if(!in_array($discount->product->id,$compare))
                                                    <a class="add-to-compare-link comp" wire:click='compare({{$discount->product->id}})' style="cursor:pointer">@lang('user.Add_to_compare')</a>
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
                                                    @if(!in_array($discount->product->id,$compare))
                                                        <a class="add-to-compare-link comp" wire:click='compare({{$discount->product->id}})' style="cursor:pointer">@lang('user.Add_to_compare')</a>
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
                        </div>
                        <!-- /.product-6 -->
                        <div class="products-6">
                            <div class="woocommerce columns-3">
                                <div class="products">
                                    @foreach($discountProducts->skip(6)->take(6) as $discount)
                                    <div class="product">
                                        <div class="yith-wcwl-add-to-wishlist">
                                            <a style="position: absolute;right: 0;top: 0;cursor:pointer;" @auth wire:click='wishlists({{$discount->id}})' @else href='{{route('login')}}' @endauth>
                                                <i class="fa fa-heart-o fa-2x wish @auth
                                                @if($wishlist_product_id->contains($discount->id)) change_color
                                                @endif
                                                @endauth"></i>
                                           </a>                                        </div>
                                        <a href="{{url('/product/'. $discount->product->slug)}}" class="woocommerce-LoopProduct-link">
                                            <span class="onsale">
                                                <span class="woocommerce-Price-amount amount">
                                                    {!! curr($discount->product->calc_price() - $discount->product->priceDiscount()) !!}</span>
                                            </span>
                                            <img src="{{Storage::url($discount->product->image)}}" class="wp-post-image" alt="{{$discount->product->name}}">
                                            <span class="price">
                                                        <ins>
                                                            <span class="amount">{!! curr($discount->product->priceDiscount()) !!}</span>
                                                        </ins>
                                                        <del>
                                                            <span class="amount">{!! curr($discount->product->calc_price()) !!}</span>
                                                        </del>
                                                    </span>
                                            <!-- /.price -->
                                            <h2 class="woocommerce-loop-product__title">{{$discount->product->name}}</h2>

                                        </a>
                                        <div class="hover-area">
                                            @if($discount->product->IsVariable())
                                            <a class="button add_to_cart_button" href='{{url('/'. $discount->product->slug)}}'
                                                rel="nofollow">@lang('user.Add_to_cart')</a>
                                                @if($compare !== null)
                                                    @if(!in_array($discount->product->id,$compare))
                                                    <a class="add-to-compare-link comp" wire:click='compare({{$discount->product->id}})' style="cursor:pointer">@lang('user.Add_to_compare')</a>
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
                                                    @if(!in_array($discount->product->id,$compare))
                                                        <a class="add-to-compare-link comp" wire:click='compare({{$discount->product->id}})' style="cursor:pointer">@lang('user.Add_to_compare')</a>
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
                        </div>
                        <!-- /.product-6 -->
                    </div>
                    <!-- /.product-1 -->
                    {{ $discountProducts->links() }}

                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <!-- /.6-1-6-products-tabs -->
    </section>
    <!-- /.section-6-1-6-products-tabs -->
    </div>
