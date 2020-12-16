<div class="product-actions-wrapper">
    <div class="product-actions">
        <div class="availability" wire:ignore>
            @lang('user.Availability'):
            @if($this->product->stock > 0)
            <p class="stock in-stock">{{$this->product->stock}} @lang('user.in_stock')</p>
            @else
            <p class="stock text-danger"> @lang('user.out_stock')</p>
            @endif
        </div>

        <!-- .additional-info -->
        <p class="price" wire:ignore>
            @if($this->product->isVariable())
            @php
                $heighest_price = $this->product->variations()->where('visible','visible')
                ->orderBy('sale_price', 'desc')->first();
            @endphp
            @endif
            @if($this->product->available_discount())
                <ins>
                    <span class="amount">{!! curr($this->product->priceDiscount()) !!} @if($this->product->isVariable() && $heighest_price) - {!! curr($heighest_price->priceDiscount()) !!} @endif </span>
                </ins>
                <del>
                    <span class="amount">{!! curr($this->product->calc_price()) !!}</span>
                </del>
                @else
                <ins>
                    <span class="amount">{!! curr($this->product->calc_price()) !!} @if($this->product->isVariable()  && $heighest_price) - {!! curr($heighest_price->calc_price()) !!} @endif</span>
                </ins>
            @endif
        </p>
        <!-- .price -->
{!! Form::open(['url' => route('product_variation_add_cart', $this->product->slug), 'method' => 'put',
'class' => 'variations_form cart']) !!}
            @if($this->product->IsVariable())
            <table class="variations">
                <tbody>
                    @if(!blank($familyAttributes))
                        @foreach($familyAttributes as $index => $parent)
                            <div class="checkbox accessory-checkbox">
                                {{$parent->name}}
                                <label>
                                    <select required data-show_option_none="yes" data-attribute_name="attributes"
                                    name="attributes[]" class="" id="pa_{{$parent->id}}" @if($loop->first) wire:model="attribute" wire:change="get_variation()" @endif>
                                        <option value="">@lang('user.Choose_an_option')</option>
                                        @foreach($parent->attributes as $attri)
                                        @if($index != 0)
                                            @if(!blank($this->productAttributes))
                                                @if(collect($this->productAttributes)->pluck('id')->contains($attri->id))
                                                    <option value="{{$attri->id}}">{{$attri->name}}</option>
                                                @endif
                                            @else
                                                <option value="{{$attri->id}}">{{$attri->name}}</option>
                                            @endif
                                        @else
                                            <option value="{{$attri->id}}">{{$attri->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        @endforeach
                    @endif
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
                        <label for="quantity-input">@lang('user.quantity')</label>
                    <input required id="quantity-input" type="parseInt" name="quantity" value="1" min="1" max="{{$this->product->stock}}" title="Qty"
                            class="input-text qty text" size="4">
                    </div>
                    @error('quantity') <span class="error text-danger">{{ $message }}</span> @enderror
                        <button class="single_add_to_cart_button button alt wc-variation-selection-needed tooltip_cart add_to_cart"
                        @if($this->product->product_type === 'variable') disabled @endif{{($this->product->stock <= 0)?'disabled':''}} type="submit">@lang('user.Add_to_cart')
                         @if($this->product->product_type === 'variable')
                         <span class="tooltiptext_cart">@lang('user.please_provide_the_missing_information_first')</span>
                         @endif
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
    var sku      = '{{$this->product->sku}}';
    var stock    = '{{$this->product->stock . ' ' . trans("user.".$this->product->in_stock)}}';

    @if($this->product->available_discount())
        var mainppss  = '{!! curr($this->product->calc_price()) !!}';
        var offerppss = '{!! curr($this->product->priceDiscount()) !!}';
        var offer     = '{!! curr($this->product->calc_price() - $this->product->priceDiscount()) !!}';
    @else
        var mainppss  = '{!! curr($this->product->calc_price()) !!}';
        var offerppss = '0';
    @endif
    function countSelected(e) {
        var toReturn = true;
        $('.product-actions-wrapper select:visible').each(function (i) {
            if (!$(this).val()) {
                toReturn = false;

                @if($this->product->product_type === 'variable')
                $('.add_to_cart').attr('disabled', 'disabled');
                $('.add_to_cart').addClass('tooltip_cart');
                $('<span class="tooltiptext_cart">@lang("user.please_provide_the_missing_information_first")</span>').appendTo('.add_to_cart');
                @endif
            };
        });
        if (toReturn === true) {
            @if($this->product->product_type === 'variable')

            $('.add_to_cart').attr('disabled', false);
            $('.add_to_cart').removeClass('tooltip_cart');

            $('.tooltiptext_cart').remove();
            @endif

            items = [];
            $.each($(".product-actions-wrapper select"), function () {
                if(jQuery.inArray($(this).val(), items) !== false) {
                    items.push( parseInt($(this).val()) );
                }
            });

            axios.post('{{route("get_data")}}', {
                _token: '{{csrf_token()}}',
                data  : items,
                seq   : '{{$this->product->id}}'
            }).then(
                (response) => {
                    if(response.data['ppss'] == 0 || response.data == '') {
                        if(offerppss == 0) {
                            $('.product-actions-wrapper ins .amount').text(mainppss);
                            $('span.sku').text(sku);
                            $('p.stock').text(stock);
                            if(stock <= 0) {
                            $('p.stock').addClass('text-danger').removeClass('in-stock');
                            } else {
                                $('p.stock').addClass('in-stock').removeClass('text-danger');
                            }
                        } else {
                        $('.product-actions-wrapper ins .amount').text(offerppss);
                        $('.product-actions-wrapper del .amount').text(mainppss);
                        $('.onsale .woocommerce-Price-amount').text(offer);
                        $('span.sku').text(sku);
                        $('p.stock').text(stock);
                        if(stock <= 0) {
                            $('p.stock').addClass('text-danger').removeClass('in-stock');
                            } else {
                                $('p.stock').addClass('in-stock').removeClass('text-danger');
                            }
                        }
                    } else {
                        if(response.data['offerppss'] == 0) {
                        $('.product-actions-wrapper del .amount').text(response.data['ppss']);
                        $('span.sku').text(response.data['sku']);
                        $('p.stock').text(response.data['stock']);
                        if(response.data['stock'] <= 0) {
                            $('p.stock').addClass('text-danger').removeClass('in-stock');
                        } else {
                            $('p.stock').addClass('in-stock').removeClass('text-danger');
                        }
                        } else {
                            $('.product-actions-wrapper ins .amount').text(response.data['offerppss']);
                            $('.product-actions-wrapper del .amount').text(response.data['ppss']);
                            $('.onsale .woocommerce-Price-amount').text(response.data['offer']);
                            $('span.sku').text(response.data['sku']);
                            $('p.stock').text(response.data['stock']);
                            if(response.data['stock'] <= 0) {
                            $('p.stock').addClass('text-danger').removeClass('in-stock');
                            } else {
                                $('p.stock').addClass('in-stock').removeClass('text-danger');
                            }
                        }
                    }
            },
	        (error) => {
                Swal.fire({
                position         : 'center',
                icon             : 'danger',
                title            : '@lang("user.this_option_is_not_available")',
                text             : '@lang("user.it_will_be_available_soon")',
                showConfirmButton: true,
                timer            : 1500
                });
                if(offerppss == 0) {
                            $('.product-actions-wrapper ins .amount').text(mainppss);
                            $('span.sku').text(sku);
                            $('p.stock').text(stock);
                            if(stock <= 0) {
                            $('p.stock').addClass('text-danger').removeClass('in-stock');
                            } else {
                                $('p.stock').addClass('in-stock').removeClass('text-danger');
                            }
                        } else {
                        $('.product-actions-wrapper ins .amount').text(offerppss);
                        $('.product-actions-wrapper del .amount').text(mainppss);
                        $('.onsale .woocommerce-Price-amount').text(offer);
                        $('span.sku').text(sku);
                        $('p.stock').text(stock);
                        if(stock <= 0) {
                            $('p.stock').addClass('text-danger').removeClass('in-stock');
                            } else {
                                $('p.stock').addClass('in-stock').removeClass('text-danger');
                            }
                        }
            }
            )
        }
    };
    $('.product-actions-wrapper select').on('change', countSelected);


</script>
@endpush
