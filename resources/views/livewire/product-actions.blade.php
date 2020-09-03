@php
if(count($this->productAttributes) == 0) {
$productAttributes = $this->product->attributes()->select('id')->get();
};
$proAttr = $this->product->attributes()->select('id')->get();
@endphp
<div class="product-actions-wrapper">
    <div class="product-actions">
        <div class="availability">
            @lang('user.Availability'):
            @if($this->product->stock > 0)
            <p class="stock in-stock">{{$this->product->stock}} @lang('user.in_stock')</p>
            @else
            <p class="stock text-danger"> @lang('user.out_stock')</p>
            @endif
        </div>

        <!-- .additional-info -->
        <p class="price">
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
        </p>
        <!-- .price -->
{!! Form::open(['url' => route('product_variation_add_cart', $this->product->slug), 'method' => 'put',
'class' => 'variations_form cart']) !!}
            @if($this->product->IsVariable())
            <table class="variations">
                <tbody>
                    {{-- <tr class=''>
                        <td class="value">
                            <div class='alert alert-danger options_alert' hide>@lang('user.please_provide_the_missing_information_first')</div>
                        </td>
                    </tr> --}}
                    @foreach($family as $index => $fam)
                    @if($index != 0)
                    <tr>
                        <td class="label">
                            <label for="pa_{{$fam->id}}">{{$fam->name}}</label>
                        </td>
                        <td class="value">
                            <select required data-show_option_none="yes" data-attribute_name="attributes"
                                name="attributes[]" class="" id="pa_{{$fam->id}}">
                                <option value="" selected>Choose an option</option>
                                @foreach($fam->attributes as $attr)
                                @if(empty($this->productAttributes))
                                @if($productAttributes->pluck('id')->contains($attr->id))
                                <option value="{{$attr->id}}" class="attached enabled">{{$attr->name}}</option>
                                @endif
                                @else
                                @if(collect($this->productAttributes)->pluck('id')->contains($attr->id))
                                <option value="{{$attr->id}}" class="attached enabled">{{$attr->name}}</option>
                                @endif
                                @endif
                                @endforeach
                            </select>
                            <a href="#" class="reset_variations" style="visibility: hidden;">Clear</a>
                            @if ($errors->has('attributes'))
                            <div id="attributes-error" class="error text-danger pl-3" for="attributes" style="display: block;">
                            <strong>{{ $errors->first('attributes') }}</strong>
                            </div>
                        @endif
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td class="label">
                            <label for="pa_{{$fam->id}}">{{$fam->name}}</label>
                        </td>
                        <td class="value">
                            @if(count($family) === 1)
                            <select required data-show_option_none="yes" data-attribute_name="attributes"
                                name="attributes[]"
                                class="" id="pa_{{$fam->id}}">
                            @else
                            <select required data-show_option_none="yes" data-attribute_name="attributes"
                                name="attributes[]"
                                class="" id="pa_{{$fam->id}}" wire:model="attribute" wire:change="get_variation()">
                                @endif
                                <option value="">Choose an option</option>
                                @foreach($fam->attributes as $attr)
                                @if(collect($proAttr)->pluck('id')->contains($attr->id))
                                <option value="{{$attr->id}}" class="attached enabled">{{$attr->name}}</option>
                                @endif
                                @endforeach
                            </select>
                            <a href="#" class="reset_variations" style="visibility: hidden;">Clear</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @else
            <table class="variations">
            <tbody class="cat-and-sku">
                <tr class="sku_wrapper">
                    <td class="label">
                        <label class="font-weight-bold">@lang('user.Color') :</label>
                    </td>
                    <td class="value">
                        {{$this->product->color}}
                    </td>
                </tr>
                <tr class="sku_wrapper">
                    <td class="label">
                        <label class="font-weight-bold">@lang('user.Size') :</label>
                    </td>
                    <td class="value">
                        {{$this->product->size}}
                    </td>
                </tr>
            </tbody>
            </table>
            @endif
            <div class="single_variation_wrap" wire:ignore>
                <div
                    class="woocommerce-variation-add-to-cart variations_button woocommerce-variation-add-to-cart-disabled">
                    <div class="quantity">
                        <label for="quantity-input">Quantity</label>
                    <input required id="quantity-input" type="parseInt" name="quantity" value="1" min="1" max="{{$this->product->stock}}" title="Qty"
                            class="input-text qty text" size="4">
                    </div>
                    @error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button class="single_add_to_cart_button button alt wc-variation-selection-needed tooltip_cart add_to_cart"
                         disabled {{($this->product->stock <= 0)?'disabled':''}} type="submit">@lang('user.Add_to_cart')
                            <span class="tooltiptext_cart">@lang('user.please_provide_the_missing_information_first')</span>
                        </button>
                    <input type="hidden" value="2471" name="add-to-cart">
                    <input type="hidden" value="2471" name="product_id">
                    <input type="hidden" value="0" class="variation_id" name="variation_id">
                </div>
            </div>
            <!-- .single_variation_wrap -->
        <!-- .variations_form -->
        {!! Form::close() !!}
        <a class="add-to-compare-link" wire:click='compare' style="cursor:pointer">@lang('user.Add_to_compare')</a>
    </div>
    <!-- .product-actions -->
</div>
@push('css')
<style>
    .tooltip_cart {
      position  : relative;
      display   : inline-block;
      text-align: center;
    }

    .tooltip_cart .tooltiptext_cart {
        visibility: hidden;
        width: 234px;
        background-color: red;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 8px 0;
        position: absolute;
        z-index: 1;
        bottom: 125%;
        left: 25%;
        margin-left: -60px;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .tooltip_cart .tooltiptext_cart::after {
      content: "";
      position: absolute;
      top: 100%;
      left: 50%;
      margin-left: -5px;
      border-width: 5px;
      border-style: solid;
      border-color: red transparent transparent transparent;
    }

    .tooltip_cart:hover .tooltiptext_cart {
      visibility: visible;
      opacity: 1;
    }
</style>
@endpush
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.1/axios.min.js"></script>
<script>
    var items    = [];
    var sku = '{{$this->product->sku}}';


    @if(isset($this->product->discount))
        var mainppss = '{!! curr($this->product->sale_price) !!}';
        var offerppss = '{!! curr($this->product->priceDiscount()) !!}';
        var offer = '{!! curr($this->product->sale_price - $this->product->priceDiscount()) !!}';
    @else
        var mainppss = '{!! curr($this->product->sale_price) !!}';
        var offerppss = '0';
    @endif
    function countSelected(e) {
        var toReturn = true;
        $('.product-actions-wrapper select:visible').each(function (i) {
            if (!$(this).val()) {
                toReturn = false;
                $('.add_to_cart').attr('disabled', 'disabled');
                $('.add_to_cart').addClass('tooltip_cart');

                $('<span class="tooltiptext_cart">@lang("user.please_provide_the_missing_information_first")</span>').appendTo('.add_to_cart');
            };
        });
        if (toReturn === true) {
            $('.add_to_cart').attr('disabled', false);
            $('.add_to_cart').removeClass('tooltip_cart')
            $('.tooltiptext_cart').remove();

            items = [];
            $.each($(".product-actions-wrapper select"), function () {
                if(jQuery.inArray($(this).val(), items) !== false) {
                    items.push( parseInt($(this).val()) );
                }
            });

            axios.post('{{route("get_data")}}', {
                _token: '{{csrf_token()}}',
                data: items,
                ass: '{{$this->product->id}}'
            }).then(
                (response) => {
                    if(response.data['ppss'] == 0 || response.data == '') {
                        if(offerppss == 0) {
                            $('.product-actions-wrapper ins .amount').text(mainppss);
                            $('span.sku').text(sku);
                        } else {
                        $('.product-actions-wrapper ins .amount').text(offerppss);
                        $('.product-actions-wrapper del .amount').text(mainppss);
                        $('.onsale .woocommerce-Price-amount').text(offer);
                        $('span.sku').text(sku);
                        }
                    } else {
                        if(response.data['offerppss'] == 0) {
                        $('.product-actions-wrapper del .amount').text(response.data['ppss']);
                        $('span.sku').text(response.data['sku']);
                        } else {
                            $('.product-actions-wrapper ins .amount').text(response.data['offerppss']);
                            $('.product-actions-wrapper del .amount').text(response.data['ppss']);
                            $('.onsale .woocommerce-Price-amount').text(response.data['offer']);
                            $('span.sku').text(response.data['sku']);
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
        }
    };
    $('.product-actions-wrapper select').on('change', countSelected);


</script>
@endpush
