<div id="content" class="site-content">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb">
                <a href="{{route('home')}}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @lang('user.Compare')
            </nav>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="type-page hentry">
                        <div class="entry-content">
                            <div class="table-responsive">
                                <table class="table table-compare compare-list">
                                    <tbody>
                                        <tr>
                                            <th>@lang('user.Product')</th>
                                            @foreach($compare as $product)
                                            <td>
                                                <a class="product" href="{{route('show_product', $product->slug)}}" target="_blank">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <img style="width:300px;" height="300px;" alt=""
                                                                class="attachment-shop_catalog size-shop_catalog wp-post-image"
                                                                src="{{Storage::url($product->image)}}">
                                                        </div>
                                                    </div>
                                                    <div class="product-info">
                                                        <h3 class="product-title">{{$product->name}}</h3>
                                                        <div class="star-rating">
                                                            <span
                                                                style="width:{{$product->ratings->count() * 2 * 10}}%">Rated
                                                                <strong class="rating">5.00</strong> out of 5</span>
                                                        </div>
                                                    </div>
                                                </a>
                                                <!-- /.product -->
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>@lang('user.price')</th>
                                            @foreach($compare as $product)
                                            <td>
                                                <div class="product-price price">
                                                    @if(isset($product->discount))
                                                    @if($product->discount->condition ===
                                                    'percentage_of_product_price'
                                                    && $product->discount->start_at <= \Carbon\Carbon::now() &&
                                                        $product->discount->expire_at > \Carbon\Carbon::now())
                                                        <ins>
                                                            <span class="amount">{!!
                                                                curr($product->priceDiscount()) !!}</span>
                                                        </ins>
                                                        <del>
                                                            <span class="amount">{!! curr($product->sale_price)
                                                                !!}</span>
                                                        </del>
                                                        @elseif($product->discount->condition === 'fixed_amount'
                                                        && $product->discount->start_at <= \Carbon\Carbon::now()
                                                            && $product->discount->expire_at >
                                                            \Carbon\Carbon::now())
                                                            <ins>
                                                                <span class="amount">{!!
                                                                    curr($product->priceDiscount()) !!}</span>
                                                            </ins>
                                                            <del>
                                                                <span class="amount">{!!
                                                                    curr($product->sale_price) !!}</span>
                                                            </del>
                                                            @else
                                                            <ins>
                                                                <span class="amount">{!!
                                                                    curr($product->sale_price) !!}</span>
                                                            </ins>
                                                            @endif
                                                            @else
                                                            <ins>
                                                                <span class="amount">{!!
                                                                    curr($product->sale_price) !!}</span>
                                                            </ins>
                                                            @endif
                                                </div>
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>@lang('user.Availability')</th>
                                            @foreach($compare as $product)
                                            <td>
                                                @if($product->stock > 0)
                                                    <span class="stock in-stock">{{$product->stock}} @lang('user.in_stock')</span>
                                                    @else
                                                    <span class="stock text-danger">@lang('user.out_stock')</span>
                                                @endif
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>@lang('user.description')</th>
                                            @foreach($compare as $product)
                                            <td>
                                                {!! $product->short_description !!}
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>@lang('user.Add_to_cart')</th>
                                            @foreach($compare as $product)
                                            <td>
                                                @if($product->IsVariable())
                                                <a class="button add_to_cart_button" href='{{url('/'. $product->slug)}}'
                                                    rel="nofollow">@lang('user.Add_to_cart')</a>
                                                @else
                                                <a class="button add_to_cart_button" wire:click='addCart({{$product->id}})'
                                                    rel="nofollow">@lang('user.Add_to_cart')</a>
                                                @endif
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>@lang('user.weight')</th>
                                            @foreach($compare as $product)
                                            <td>
                                                <span>{{$product->weight}}</span>
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>@lang('user.Dimensions')</th>
                                            @foreach($compare as $product)
                                            <td>
                                            <span>@lang('user.height') : {{$product->height}}/ @lang('user.width') : {{$product->width}} / @lang('user.length') : {{$product->length}}</span>
                                            </td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>@lang('user.brand')</th>
                                            @foreach($compare as $product)
                                        <td>{{$product->tradmark->name}}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            @foreach($compare as $product)
                                            <td class="text-center">
                                                <a title="Remove" wire:click='removeCompare({{$product->id}})' class="remove-icon" style="cursor:pointer;">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- /.table-compare compare-list -->
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- .entry-content -->
                    </div>
                    <!-- .hentry -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
        <!-- .row -->
    </div>
    <!-- Modal -->
</div>
