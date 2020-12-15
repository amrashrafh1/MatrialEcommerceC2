<div class="container-fluid pt-8">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-profile  overflow-hidden">
                <div class="card-body text-center cover-image" data-image-src="assets/img/profile-bg.jpg">
                    <div class=" card-profile" wire:ignore>
                        <div class="row justify-content-center">
                            <div class="">
                                <div class="">
                                    <a href="#">
                                        <img src="{{Storage::url($store->image)}}" class="rounded-circle"
                                            alt="profile">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-3 text-white" wire:ignore>{{$store->name}}</h3>
                    <p class="mb-4 text-white" wire:ignore>@lang('user.store')</p>
                    <div class="text-center">
                        @guest
                        <a class="button text-white" style="cursor:pointer;" href="{{route('login')}}"><i
                                class="fa fa-plus"></i> @lang('user.Follow')</a>
                        @else
                        <a class="button text-white {{($this->isFollow) ? 'disabled' : ''}}"
                            style="cursor:pointer; padding:7px;" wire:click='follow'><i class="fa fa-plus"></i>
                            {{($this->isFollow) ? trans('user.followed') : trans('user.follow')}}</a>
                        @endguest
                        <h6 class="mt-1 font-weight-light " style="color: #000;">
                            ({{$this->store->followers()->count()}}) @lang('user.followers')</h6>
                    </div>

                </div>
                <div class="card-body" wire:ignore>
                    <div class="nav-wrapper p-0">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 mt-md-2 mt-0 mt-lg-0" id="tabs-icons-text-1-tab"
                                    data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                    aria-controls="tabs-icons-text-1" aria-selected="false"><i
                                        class="fa fa-home mr-2"></i>@lang('user.About')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active show mt-md-2 mt-0 mt-lg-0"
                                    id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab"
                                    aria-controls="tabs-icons-text-3" aria-selected="true"><i
                                        class="fa fa-images mr-2"></i>@lang('user.products')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card shadow mt-5">
                <div class="card-body pb-0">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade " id="tabs-icons-text-1" role="tabpanel"
                            aria-labelledby="tabs-icons-text-1-tab" wire:ignore>
                            <h2>@lang('user.about_my_store')</h2>
                            <p class="description">{{($store)?$store->description:''}}</p>
                            <div class="table-responsive border ">
                                <table class="table row table-borderless w-100 m-0 ">
                                    <tbody class="col-lg-4 p-0">
                                        <tr>
                                            <td><strong>@lang('user.Full_Name') :</strong> {{$store->name}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.email') :</strong> {{$store->email}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.business_type') :</strong> {{($store)?$store->business_type:''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.Location') :</strong> {{($store->country)?$store->country->country_name:''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.This_store_has_been_open_since') :</strong> {{$store->created_at->diffForHumans()}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="col-lg-4 p-0">
                                        <tr>
                                            <td><strong>@lang('user.Occupation') :</strong> @lang('user.seller')</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.address1') :</strong> {{($store)?$store->address1:''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.address2') :</strong> {{($store)?$store->address2:''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.address3') :</strong> {{($store)?$store->address3:''}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="col-lg-4 p-0">
                                        <tr>
                                            <td><strong>@lang('user.phone1') :</strong> {{($store)?$store->phone1:''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.phone2') :</strong> {{($store)?$store->phone2:''}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>@lang('user.phone3') :</strong> {{($store)?$store->phone3:''}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show active" id="tabs-icons-text-3" role="tabpanel"
                            aria-labelledby="tabs-icons-text-3-tab">
                            <div id="grid-extended">
                                <div class="woocommerce columns-4">
                                    <div class="products">
                                        @php
                                        $count = 1;
                                        @endphp
                                        @foreach($products as $product)
                                        <div class="product {{($count%4 == 1)?'first':''}} {{($count%4 == 0)?'last':''}}">
                                            <div class="yith-wcwl-add-to-wishlist">
                                                <a class='add_to_wishlist'
                                                @auth wire:click='wishlists({{$product->id}})' @else href='{{route('login')}}'
                                                @endauth>
                                                </a>
                                             </div>
                                            <!-- .yith-wcwl-add-to-wishlist -->
                                            <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link"
                                                href="{{route('show_product', $product->slug)}}">
                                                <img width="224" height="197" alt=""
                                                    class="attachment-shop_catalog size-shop_catalog wp-post-image"
                                                    src="{{Storage::url($product->image)}}">
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

                                                <h2 class="woocommerce-loop-product__title">{{ $product->name }}</h2>
                                            </a>
                                            <!-- .woocommerce-LoopProduct-link -->
                                            <div class="techmarket-product-rating">
                                                <div title="Rated 5.00 out of 5" class="star-rating">
                                                    <span style="width:{{$product->averageRating(null, true)[0] * 2 * 10}}%">
                                                        <strong class="rating">5.00</strong> out of 5</span>
                                                </div>
                                                <span class="review-count">({{$product->ratings()->where('approved',1)->count()}})</span>
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
                                            <a class="button product_type_simple add_to_cart_button"
                                                href='{{route('show_product',$product->slug)}}'
                                                rel="nofollow">@lang('user.Add_to_cart')</a>

                                            @if($compare !== null)
                                            @if(!in_array($product->id, $compare))
                                            <a class="add-to-compare-link comp" wire:click='compare({{$product->id}})'
                                                style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                            @else
                                            <a class="add-to-compare-link disabled" disabled>@lang('user.already_added')</a>
                                            @endif
                                            @endif
                                            @else
                                            <a class="button product_type_simple add_to_cart_button"
                                                wire:click='addCart({{$product->id}})' rel="nofollow"
                                                wire:loading.class="disabled">@lang('user.Add_to_cart')
                                                <div wire:loading>
                                                    <i class="fa fa-spinner " aria-hidden="true"></i>
                                                </div>
                                            </a>
                                            @if($compare !== null)
                                            @if(!in_array($product->id,$compare))
                                            <a class="add-to-compare-link comp" wire:click='compare({{$product->id}})'
                                                style="cursor:pointer">@lang('user.Add_to_compare')</a>
                                            @else
                                            <a class="add-to-compare-link disabled" disabled>@lang('user.already_added')</a>
                                            @endif
                                            @endif
                                            @endif
                                        </div>
                                        @php $count++; @endphp
                                        @endforeach
                                        <!-- .product -->
                                    </div>
                                    <!-- .products -->
                                </div>
                                <!-- .woocommerce -->
                            </div>
                        {!! $products->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .nav-pills .nav-link {
        font-size: .875rem;
        font-weight: 500;
        padding: .75rem 1rem;
        transition: all .15s ease;
        color: #00c3ed;
        border: 1px solid #dae0ef;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(50, 50, 93, .11), 0 1px 3px rgba(0, 0, 0, .08);
    }

</style>
