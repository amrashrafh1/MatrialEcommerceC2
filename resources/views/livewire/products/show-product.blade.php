@php
$reviewCount = DB::table('reviews')->where('reviewrateable_id', $this->product->id)->where('approved', 1)
->count();
//$direction =  (LaravelLocalization::getCurrentLocaleDirection() === 'rtl') ? 'right' :'left';
//dd($direction);
@endphp
<div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
        <div class="row">
            <nav class="woocommerce-breadcrumb" wire:ignore>
                <a href="{{route('home')}}">@lang('user.home')</a>
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>
                @if(!empty($this->product->category()->first()->slug))
                <a href="{{url('/category/'.$this->product->category()->first()->slug)}}">{{$this->product->category()->first()->name}}</a>
                @endif
                <span class="delimiter">
                    <i class="tm tm-breadcrumbs-arrow-right"></i>
                </span>{{$this->product->name}}
            </nav>
            @if (session('out_stock'))
                <div class="alert alert-danger">
                    {{ session('out_stock') }}
                </div>
            @endif
            <div class="col-md-12 mb-1 d-flex justify-content-center">
                <div class="row">
                    <nav id="primary-navigation" class="primary-navigation" aria-label="Primary Navigation"
                        data-nav="flex-menu" wire:ignore>
                        <ul id="menu-primary-menu" class="nav yamm">
                            <li class="yamm-fw menu-item menu-item-has-children animate-dropdown dropdown">
                                <a title="Pages" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true"
                            href="#">{{$this->product->seller->name}} <span class="caret ml-5"></span></a>
                                <ul role="menu" class=" dropdown-menu">
                                    <li class="menu-item menu-item-object-static_block animate-dropdown" style="width: 450px;
                                    margin: auto;">
                                        <div class="yamm-content">
                                            <div class="tm-mega-menu">
                                                <div class="widget widget_nav_menu">
                                                    <ul class="menu" style="wrap:wrap">
                                                        <li class="nav-body menu-item">
                                                            @if(isset($this->product->seller->country->country_name))
                                                            <a href="#">{{$this->product->seller->country->country_name}}</a>
                                                            @endif
                                                        </li>
                                                        <li class="nav-body menu-item">
                                                        <a href="#">@lang('user.This_store_has_been_open_since') <span class="text-danger">{{$this->product->seller->created_at->format('F j, Y')}}</span></a>
                                                        </li>
                                                        <li class="nav-body menu-item">
                                                            <a href="#" class="text-info">Store rating </a>
                                                        </li>
                                                        <li class="nav-body menu-item">
                                                            <a href="{{route('show_seller', $this->product->seller->id)}}" class="text-info">see the store <i class="fa fa-angle-double-right"></i></a>
                                                        </li>
                                                        <li class="nav-body menu-item">
                                                            <a href="{{route('show_chat', $this->product->slug)}}" class="text-info">Contact now <i class="fa fa-send"></i></a>
                                                        </li>
                                                    </ul>
                                                    <!-- .menu -->
                                                </div>
                                                <!-- .widget_nav_menu -->
                                            </div>
                                            <!-- .tm-mega-menu -->
                                        </div>
                                        <!-- .yamm-content -->
                                    </li>
                                    <!-- .menu-item -->
                                </ul>
                                <!-- .dropdown-menu -->
                            </li>
                        </ul>
                    </nav>
                    <div>
                    @guest
                    <a class="button ml-5 text-white" style="cursor:pointer;" href="{{route('login')}}"><i class="fa fa-plus"></i> Follow</a>
                    @else
                    <a class="button ml-5 text-white {{($this->isFollow) ? 'disabled' : ''}}" style="cursor:pointer; padding:7px;" wire:click='follow'><i class="fa fa-plus"></i> {{($this->isFollow) ? trans('user.followed') : trans('user.follow')}}</a>
                    @endguest
                        <h6 class="mt-1 font-weight-light text-right" style="color: #b8b8b8;">{{$this->product->seller->followers()->count()}} @lang('user.followers')</h6>
                    </div>
                </div>
            </div>
            <div style="margin:0 auto 25px;" wire:ignore>
                <img class='' src="{{Storage::url($this->product->seller->image)}}" style='height:150px;width:300px;'/>
            </div>
            <!-- .woocommerce-breadcrumb -->
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <div class="product">
                        <div class="single-product-wrapper">
                            <div class="product-images-wrapper thumb-count-4">
                                @if($this->product->available_discount())
                                <span class="onsale">
                                    <span class="woocommerce-Price-amount amount">
                                       {!! curr($this->product->calc_price() - $this->product->priceDiscount()) !!}</span>
                                </span>
                                @endif
                                <!-- .onsale -->
                                <div id="techmarket-single-product-gallery" class="techmarket-single-product-gallery techmarket-single-product-gallery--with-images techmarket-single-product-gallery--columns-4 images" data-columns="4" wire:ignore>
                                    <div class="techmarket-single-product-gallery-images" data-ride="tm-slick-carousel" data-wrap=".woocommerce-product-gallery__wrapper" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:false,&quot;asNavFor&quot;:&quot;#techmarket-single-product-gallery .techmarket-single-product-gallery-thumbnails__wrapper&quot;}">
                                        <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4">
                                            <a href="#" class="woocommerce-product-gallery__trigger">🔍</a>
                                            <figure class="woocommerce-product-gallery__wrapper ">
                                                <div data-thumb="{{Storage::url($this->product->image)}}" class="woocommerce-product-gallery__image">
                                                    <a href="{{Storage::url($this->product->image)}}" tabindex="0">
                                                        <img style="height:600px; width:600px;" src="{{Storage::url($this->product->image)}}" class="attachment-shop_single size-shop_single wp-post-image" alt="">
                                                    </a>
                                                </div>
                                                @foreach($this->product->gallery as $img)
                                                <div data-thumb="{{Storage::url($img->file)}}" class="woocommerce-product-gallery__image">
                                                    <a href="{{Storage::url($img->file)}}" tabindex="0">
                                                        <img   style="height:600px; width:600px;"  src="{{Storage::url($img->file)}}" class="attachment-shop_single size-shop_single wp-post-image" alt="">
                                                    </a>
                                                </div>
                                                @endforeach
                                            </figure>
                                        </div>
                                        <!-- .woocommerce-product-gallery -->
                                    </div>
                                    <!-- .techmarket-single-product-gallery-images -->
                                    <div class="techmarket-single-product-gallery-thumbnails" data-ride="tm-slick-carousel" data-wrap=".techmarket-single-product-gallery-thumbnails__wrapper" data-slick="{&quot;infinite&quot;:false,&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;vertical&quot;:true,&quot;verticalSwiping&quot;:true,&quot;focusOnSelect&quot;:true,&quot;touchMove&quot;:true,&quot;prevArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-up\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;nextArrow&quot;:&quot;&lt;a href=\&quot;#\&quot;&gt;&lt;i class=\&quot;tm tm-arrow-down\&quot;&gt;&lt;\/i&gt;&lt;\/a&gt;&quot;,&quot;asNavFor&quot;:&quot;#techmarket-single-product-gallery .woocommerce-product-gallery__wrapper&quot;,&quot;responsive&quot;:[{&quot;breakpoint&quot;:765,&quot;settings&quot;:{&quot;vertical&quot;:false,&quot;horizontal&quot;:true,&quot;verticalSwiping&quot;:false,&quot;slidesToShow&quot;:4}}]}">
                                        <figure class="techmarket-single-product-gallery-thumbnails__wrapper">
                                            <figure data-thumb="{{Storage::url($this->product->image)}}" class="techmarket-wc-product-gallery__image">
                                                <img  style="height:180px; width:180px;"  src="{{Storage::url($this->product->image)}}" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">
                                            </figure>
                                            @foreach($this->product->gallery as $img)
                                            <figure data-thumb="{{Storage::url($img->file)}}" class="techmarket-wc-product-gallery__image">
                                                <img  style="height:180px; width:180px;"  src="{{Storage::url($img->file)}}" class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" alt="">
                                            </figure>
                                            @endforeach
                                        </figure>
                                        <!-- .techmarket-single-product-gallery-thumbnails__wrapper -->
                                    </div>
                                    <!-- .techmarket-single-product-gallery-thumbnails -->
                                </div>
                                <!-- .techmarket-single-product-gallery -->
                            </div>
                            <!-- .product-images-wrapper -->
                            <div class="summary entry-summary">
                                <div class="single-product-header">
                                <h1 class="product_title entry-title">{{$this->product->name}}</h1>
                                @guest
                                <a style="position: absolute;{{($direction === 'right')?'left: 35px;':'right: 35px;'}} top: 0;  cursor:pointer;" href="{{route('login')}}">
                                    <i class="fa fa-heart-o fa-2x"></i>
                               </a>
                                @else
                                <a style="position: absolute;{{($direction === 'right')?'left: 35px;':'right: 35px;'}} top: 0; cursor:pointer;" wire:click='wishlists'>
                                     <i class="fa fa-heart-o fa-2x wish @auth
                                     @if($this->isWishlist) change_color
                                     @endif
                                     @endauth"></i>
                                </a>
                                @endguest
                                </div>
                                <!-- .single-product-header -->
                                <div class="single-product-meta">
                                    @if(!empty($this->product->tradmark()->first()->logo))
                                    <div class="brand">
                                        <a href="{{url('/brand/'. $this->product->tradmark()->first()->slug)}}">
                                            <img alt="galaxy" src="{{Storage::url($this->product->tradmark()->first()->logo)}}">
                                        </a>
                                    </div>
                                    @endif
                                    <div class="cat-and-sku">
                                        @if(!empty($this->product->category()->first()->name))
                                        <span class="posted_in categories">
                                            <a rel="tag" href="{{url('/category/'.$this->product->category()->first()->slug)}}">{{$this->product->category()->first()->name}}</a>
                                        </span>
                                        @endif
                                        <span class="sku_wrapper">@lang('user.SKU'):
                                            <span class="sku">{{$this->product->sku}}</span>
                                        </span>
                                    </div>
                                    @if($this->product->averageRating(null, true)[0] > 4.5 && $this->product->averageRating(null, true)[0] < 5)
                                    <div class="product-label">
                                        <div class="ribbon label green-label">
                                            <span>A+</span>
                                        </div>
                                    </div>
                                    @elseif($this->product->averageRating(null, true)[0] == 5)
                                    <div class="product-label">
                                        <div class="ribbon label green-label">
                                            <span>A++</span>
                                        </div>
                                    </div>
                                    @elseif($this->product->averageRating(null, true)[0] > 4 && $this->product->averageRating(null, true)[0] < 4.5)
                                    <div class="product-label">
                                        <div class="ribbon label green-label">
                                            <span>A</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <!-- .single-product-meta -->
                                <div class="rating-and-sharing-wrapper">
                                    <div class="woocommerce-product-rating">
                                        <div class="star-rating">
                                            <span style="width:{{$this->product->averageRating(null, true)[0] * 2 * 10}}%">Rated
                                                <strong class="rating">5.00</strong> out of 5 based on
                                                <span class="rating">1</span> customer rating</span>
                                        </div>
                                    <a rel="nofollow" class="woocommerce-review-link" href="#reviews">(<span class="count">{{DB::table('reviews')
                                        ->where('reviewrateable_id', $this->product->id)->where('approved', 1)
                                        ->count()}})</span> customer review)</a>
                                    </div>
                                </div>
                                <!-- .rating-and-sharing-wrapper -->
                                <div class="woocommerce-product-details__short-description mb-4" style="border-bottom: 1px solid #ebebeb;">
                                    {!! $this->product->description !!}
                                </div>
                                <div class="woocommerce-product-details__short-description">
                                    <h6 class="mb-2">@lang('user.tags:')</h6>
                                    @foreach($this->product->tags as $tag)
                                    <ul class="tags">
                                        <li><a href="{{route('tags', $tag->slug)}}" class="tag">{{$tag->name}}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- .woocommerce-product-details__short-description -->
                            </div>
                            <!-- .entry-summary -->
                            @livewire('product-actions', ['product'=>$this->product])

                        <!-- .single-product-wrapper -->
                        <div class="techmarket-tabs techmarket-tabs-wrapper wc-tabs-wrapper">
                            <div id="tab-accessories" class="techmarket-tab">
                                <div class="tab-content">
                                    <ul role="tablist" class="nav tm-tabs">
                                        <li class="accessories_tab active">
                                            <a href="#tab-accessories">@lang('user.Accessories')</a>
                                        </li>
                                        <li class="description_tab">
                                            <a href="#tab-description">@lang('admin.description')</a>
                                        </li>
                                        <li class="reviews_tab">
                                            <a href="#tab-reviews">Reviews ({{$reviewCount}})</a>
                                        </li>
                                    </ul>
                                    <!-- /.ec-tabs -->
                                    {!! Form::open(['url' => route('product_add_accessories'), 'method' => 'put']) !!}
                                    <div class="accessories">
                                        <div class="accessories-wrapper">
                                            <div class="accessories-product columns-4">
                                                <div class="products">
                                                    @foreach($this->product->accessories()->where('visible','visible')->where('in_stock', 'in_stock')
                                                    ->get() as $index => $accessory)
                                                    <div class="product" id='{{$accessory->id}}' wire:ignore>
                                                        <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link" href="{{route('show_product', $accessory->slug)}}">
                                                            <img style="height:197px; width:224px;" alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image" src="{{Storage::url($accessory->image)}}">
                                                            <span class="price">
                                                                @if($accessory->available_discount())
                                                                    <ins>
                                                                        <span class="amount">{!! curr($accessory->priceDiscount()) !!}</span>
                                                                    </ins>
                                                                    <del>
                                                                        <span class="amount">{!! curr($accessory->calc_price()) !!}</span>
                                                                    </del>
                                                                    @else
                                                                    <ins>
                                                                        <span class="amount">{!! curr($accessory->calc_price()) !!}</span>
                                                                    </ins>
                                                                @endif
                                                            </span>
                                                            <h2 class="woocommerce-loop-product__title">{{$accessory->name}}</h2>
                                                        </a>
                                                        @if($accessory->product_type === 'variable')
                                                        @php
                                                            $accessory_attributes = $accessory->attributes;
                                                            $parents     = [];
                                                            /* loop attributes and get parent who has this attributes [not all family] */
                                                            foreach($accessory_attributes as $attr) {
                                                                $id  = $attr->id;
                                                                $ff  = \App\Attribute_Family::whereHas('attributes', function ($q) use ($id) {
                                                                    $q->where('id', $id);
                                                                })->first();

                                                                if(!in_array($ff, $parents)) {
                                                                    array_push($parents,$ff);
                                                                }
                                                            }
                                                        @endphp
                                                        @if(!empty($parents))
                                                        @foreach($parents as $parent)
                                                        <div class="checkbox accessory-checkbox">
                                                            {{$parent->name}}
                                                            <label>
                                                            <select name="options[{{$accessory->id}}][]"  required data-show_option_none="yes" data-attribute_name="attributes">
                                                                <option value="">Choose an option</option>
                                                                @foreach($parent->attributes as $attri)
                                                                @if($accessory->attributes->contains($attri->id))
                                                                    <option value="{{$attri->id}}">{{$attri->name}}</option>
                                                                @endif
                                                                @endforeach
                                                            </select>
                                                            </label>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                        @endif
                                                        <div class="checkbox accessory-checkbox">
                                                            <label>
                                                            <input name="accessories[]" wire:model='accessories' value="{{$accessory->id}}" type="checkbox" data-product-type="simple" data-product-id="185" data-price="997.00" class="product-check" checked=""> @lang('user.add')
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <!-- /.products -->
                                            </div>
                                            <!-- .row -->
                                            <div class="accessories-product-total-price">
                                                <div class="total-price">
                                                    <span class="total-price-html price">
                                                        <span class="woocommerce-Price-amount amount">
                                                            {!! curr($this->total) !!}
                                                        </span>
                                                    </span>
                                                    <!-- .total-price-html -->
                                                    <span>@lang('user.Bundle_Price_for_Selected_items')</span>
                                                </div>
                                                <!-- .total-price -->
                                                <div class="accessories-add-all-to-cart">
                                                    <button class="button btn btn-primary add-all-to-cart" type="submit">@lang('user.Add_Bundle_to_cart')</button>
                                                </div>
                                                <!-- .accessories-add-all-to-cart -->
                                            </div>
                                            <!-- .accessories-product-total-price -->
                                        </div>
                                        <!-- .accessories-wrapper -->
                                    </div>
                                    {!! Form::close() !!}
                                    <!-- .accessories -->
                                </div>
                                <!-- .tab-content -->
                            </div>
                            <!-- .techmarket-tab -->
                            <div id="tab-description" class="techmarket-tab">
                                <div class="tab-content">
                                    <ul role="tablist" class="nav tm-tabs">
                                        <li class="accessories_tab">
                                            <a href="#tab-accessories">@lang('user.Accessories')</a>
                                        </li>
                                        <li class="description_tab active">
                                            <a href="#tab-description">@lang('admin.description')</a>
                                        </li>
                                        <li class="reviews_tab">
                                            <a href="#tab-reviews">Reviews ({{$reviewCount}})</a>
                                        </li>
                                    </ul>
                                    <!-- /.ec-tabs -->
                                    <h2>@lang('admin.description')</h2>
                                    {!! $this->product->description !!}
                                    <!-- .outer-wrap -->
                                </div>
                                <!-- .tab-content -->
                            </div>
                            <!-- .techmarket-tab -->

                            <!-- .techmarket-tab -->
                            <div id="tab-reviews" class="techmarket-tab">
                                <div class="tab-content">
                                    <ul role="tablist" class="nav tm-tabs">
                                        <li class="accessories_tab">
                                            <a href="#tab-accessories">@lang('user.Accessories')</a>
                                        </li>
                                        <li class="description_tab">
                                            <a href="#tab-description">@lang('admin.description')</a>
                                        </li>
                                        <li class="reviews_tab active">
                                            <a href="#tab-reviews">Reviews ({{$reviewCount}})</a>
                                        </li>
                                    </ul>
                                    <!-- /.ec-tabs -->
                                    @livewire('products.add-reviews', ['product' => $this->product])
                                </div>
                                <!-- .tab-content -->
                            </div>
                            <!-- .techmarket-tab -->
                        </div>
                        <!-- .techmarket-tabs -->
                        @livewire('related-product', ['product' => $this->product, 'tags' => $this->product->tags])
                        <!-- .tm-related-products-carousel -->
                        @livewire('products.recently-product')
                        <!-- .section-landscape-products-carousel -->
                        <section style='width: 100%;' class="brands-carousel" wire:ignore>
                            <h2 class="sr-only">Brands Carousel</h2>
                            <div class="col-full" data-ride="tm-slick-carousel" data-wrap=".brands" data-slick="{&quot;slidesToShow&quot;:6,&quot;slidesToScroll&quot;:1,&quot;dots&quot;:false,&quot;arrows&quot;:true,&quot;responsive&quot;:[{&quot;breakpoint&quot;:400,&quot;settings&quot;:{&quot;slidesToShow&quot;:1,&quot;slidesToScroll&quot;:1}},{&quot;breakpoint&quot;:800,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;slidesToShow&quot;:3,&quot;slidesToScroll&quot;:3}},{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:4,&quot;slidesToScroll&quot;:4}},{&quot;breakpoint&quot;:1400,&quot;settings&quot;:{&quot;slidesToShow&quot;:5,&quot;slidesToScroll&quot;:5}}]}">
                                <div class="brands">
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>apple</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="apple" src="{{url('/')}}/FrontEnd/images/brands/1.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>bosch</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="bosch" src="{{url('/')}}/FrontEnd/images/brands/2.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>cannon</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="cannon" src="{{url('/')}}/FrontEnd/images/brands/3.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>connect</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="connect" src="{{url('/')}}/FrontEnd/images/brands/4.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>galaxy</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="galaxy" src="{{url('/')}}/FrontEnd/images/brands/5.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>gopro</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="gopro" src="{{url('/')}}/FrontEnd/images/brands/6.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>handspot</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="handspot" src="{{url('/')}}/FrontEnd/images/brands/7.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>kinova</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="kinova" src="{{url('/')}}/FrontEnd/images/brands/8.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>nespresso</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="nespresso" src="{{url('/')}}/FrontEnd/images/brands/9.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>samsung</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="samsung" src="{{url('/')}}/FrontEnd/images/brands/10.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>speedway</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="speedway" src="{{url('/')}}/FrontEnd/images/brands/11.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                    <div class="item">
                                        <a href="shop.html">
                                            <figure>
                                                <figcaption class="text-overlay">
                                                    <div class="info">
                                                        <h4>yoko</h4>
                                                    </div>
                                                    <!-- /.info -->
                                                </figcaption>
                                                <img width="145" height="50" class="img-responsive desaturate" alt="yoko" src="{{url('/')}}/FrontEnd/images/brands/12.png">
                                            </figure>
                                        </a>
                                    </div>
                                    <!-- .item -->
                                </div>
                            </div>
                            <!-- .col-full -->
                        </section>
                        <!-- .brands-carousel -->
                    </div>
                    <!-- .product -->
                </main>
                <!-- #main -->
            </div>
            <!-- #primary -->
        </div>
        <!-- .row -->
    </div>
    <!-- .col-full -->
</div>


@push('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script>
    @foreach($this->product->accessories()->select('sale_price', 'id','product_type')->get() as $accessory)

    document.addEventListener('DOMContentLoaded', function () {
        @if($accessory->available_discount())
            @this.set('prices.{{$accessory->id}}', {{$accessory->priceDiscount()}});
        @else
            @this.set('prices.{{$accessory->id}}', {{$accessory->calc_price()}});
        @endif
    });



    @if($accessory->product_type === 'variable')
    var options{{$accessory->id}}    = [];
    @if($accessory->available_discount())
        var mainppss{{$accessory->id}} = '{!! curr($accessory->calc_price()) !!}';
        var offerppss{{$accessory->id}} = '{!! curr($accessory->priceDiscount()) !!}';
        var offer{{$accessory->id}} = '{!! curr($accessory->calc_price() - $accessory->priceDiscount()) !!}';
    @else
        var mainppss{{$accessory->id}} = '{!! curr($accessory->calc_price()) !!}';
        var offerppss{{$accessory->id}} = '0';
    @endif
    function countSelected{{$accessory->id}} (e) {
        var toReturn = true;
        $('#{{$accessory->id}} select:visible').each(function (i) {
            if (!$(this).val()) {
                toReturn = false;
            };
        });
        if (toReturn === true) {
            options{{$accessory->id}} = [];
            $.each($("#{{$accessory->id}} select"), function () {
                if(jQuery.inArray($(this).val(), options{{$accessory->id}}) !== false) {
                    options{{$accessory->id}}.push( parseInt($(this).val()) );
                }
            });

            axios.post('{{route("get_data")}}', {
                _token: '{{csrf_token()}}',
                data  : options{{$accessory->id}},
                ass   : '{{$accessory->id}}'
            }).then(
                (response) => {
                    if(response.data['ppss'] == 0 || response.data == '') {
                        if(offerppss{{$accessory->id}} == 0) {
                            $('#{{$accessory->id}} ins .amount').text(mainppss{{$accessory->id}});
                            @this.set('prices.{{$accessory->id}}', {{$accessory->sale_price}});

                            } else {
                        $('#{{$accessory->id}} ins .amount').text(offerppss{{$accessory->id}});
                        $('#{{$accessory->id}} del .amount').text(mainppss{{$accessory->id}});
                        @this.set('prices.{{$accessory->id}}', {{$accessory->priceDiscount()}});
                        }
                    } else {
                        if(response.data['offerppss'] == 0) {
                        $('#{{$accessory->id}} del .amount').text(response.data['ppss']);
                        @this.set('prices.{{$accessory->id}}', response.data['ppssNormal']);
                        } else {
                            $('#{{$accessory->id}} ins .amount').text(response.data['offerppss']);
                            $('#{{$accessory->id}} del .amount').text(response.data['ppss']);
                            @this.set('prices.{{$accessory->id}}', response.data['offerppssNormal']);
                        }
                    }
                },
	        (error) => {
                Swal.fire({
                position: 'top-end',
                icon: 'danger',
                title: '{{trans("user.this_option_is_out_stock")}}',
                showConfirmButton: true,
                timer: 1500
                });
            }

            )

    };
    };
    $('#{{$accessory->id}} select').on('change', countSelected{{$accessory->id}});
    @endif
    @endforeach
</script>
@endpush


@push('css')
<style>
.tags {
  list-style: none;
  margin: 0;
  overflow: hidden;
  padding: 0;
}

.tags li {
  float: left;
}

.tag {
  background: #eee;
  border-radius: 3px 0 0 3px;
  color: #999;
  display: inline-block;
  height: 26px;
  line-height: 26px;
  padding: 0 20px 0 23px;
  position: relative;
  margin: 0 10px 10px 0;
  text-decoration: none;
  -webkit-transition: color 0.2s;
}

.tag::before {
  background: #fff;
  border-radius: 10px;
  box-shadow: inset 0 1px rgba(0, 0, 0, 0.25);
  content: '';
  height: 6px;
  left: 10px;
  position: absolute;
  width: 6px;
  top: 10px;
}

.tag::after {
  background: #fff;
  border-bottom: 13px solid transparent;
  border-left: 10px solid #eee;
  border-top: 13px solid transparent;
  content: '';
  position: absolute;
  right: 0;
  top: 0;
}

.tag:hover {
  background-color: #0063D1;
  color: white;
}

.tag:hover::after {
   border-left-color: #0063D1;
}
</style>
@endpush
