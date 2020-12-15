{!! Form::open(['url' => route('product_add_accessories'), 'method' => 'put']) !!}
<div class="accessories">
    <div class="accessories-wrapper">
        <div class="accessories-product columns-4" wire:ignore>
            <div class="products">
                @foreach($accesso as $index => $accessory)
                <div class="product" id='{{$accessory->slug}}'>
                    <a class="woocommerce-LoopProduct-link woocommerce-loop-product__link"
                        href="{{route('show_product', $accessory->slug)}}">
                        <img alt="" class="attachment-shop_catalog size-shop_catalog wp-post-image"
                            src="{{Storage::url($accessory->image)}}">
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
                            $familyAttributes = $accessory->getParentAttributes();
                        @endphp

                        @if(!blank($familyAttributes))
                            @foreach($familyAttributes as $index => $parent)
                            <div class="checkbox accessory-checkbox">
                                {{$parent->name}}
                                <label>
                                    <select name="options[{{$accessory->id}}][]" required data-show_option_none="yes"
                                        data-attribute_name="attributes">
                                        <option value="">@lang('user.Choose_an_option')</option>
                                        @foreach($parent->attributes as $attri)
                                        <option value="{{$attri->id}}">{{$attri->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            @endforeach
                        @endif
                    @endif
                    <div class="checkbox accessory-checkbox">
                        <label>
                            <input name="accessories[]" wire:model='accessories' value="{{$accessory->id}}"
                                type="checkbox" data-product-type="simple" data-product-id="185" data-price="997.00"
                                class="product-check" checked=""> @lang('user.add')
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
                <button class="button btn btn-primary add-all-to-cart"
                    type="submit">@lang('user.Add_Bundle_to_cart')</button>
            </div>
            <!-- .accessories-add-all-to-cart -->
        </div>
        <!-- .accessories-product-total-price -->
    </div>
    <!-- .accessories-wrapper -->
</div>
{!! Form::close() !!}



@push('js')
<script>
    @foreach($accesso as $accessory)

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
        var mainppss  = '{!! curr($this->product->calc_price()) !!}';
        var offerppss = '{!! curr($this->product->priceDiscount()) !!}';
        var offer     = '{!! curr($this->product->calc_price() - $this->product->priceDiscount()) !!}';
    @else
        var mainppss  = '{!! curr($this->product->calc_price()) !!}';
        var offerppss = '0';
    @endif
    function countSelected{{$accessory->id}} (e) {
        var toReturn = true;
        $('#{{$accessory->slug}} select:visible').each(function (i) {
            if (!$(this).val()) {
                toReturn = false;
            };
        });
        if (toReturn === true) {
            options{{$accessory->id}} = [];
            $.each($("#{{$accessory->slug}} select"), function () {
                if(jQuery.inArray($(this).val(), options{{$accessory->id}}) !== false) {
                    options{{$accessory->id}}.push( parseInt($(this).val()) );
                }
            });

            axios.post('{{route("get_data")}}', {
                _token: '{{csrf_token()}}',
                data  : options{{$accessory->id}},
                seq   : '{{$accessory->id}}'
            }).then(
                (response) => {
                    if(response.data['ppss'] == 0 || response.data == '') {
                        if(offerppss{{$accessory->id}} == 0) {
                            $('#{{$accessory->slug}} ins .amount').text(mainppss{{$accessory->id}});
                            @this.set('prices.{{$accessory->id}}', {{$accessory->calc_price()}});

                        } else {

                            $('#{{$accessory->slug}} ins .amount').text(offerppss{{$accessory->id}});
                            $('#{{$accessory->slug}} del .amount').text(mainppss{{$accessory->id}});
                            @this.set('prices.{{$accessory->id}}', {{$accessory->priceDiscount()}});
                        }
                    } else {
                        if(response.data['offerppss'] == 0) {

                            $('#{{$accessory->slug}} del .amount').text(response.data['ppss']);
                            @this.set('prices.{{$accessory->id}}', response.data['ppssNormal']);

                        } else {

                            $('#{{$accessory->slug}} ins .amount').text(response.data['offerppss']);
                            $('#{{$accessory->slug}} del .amount').text(response.data['ppss']);
                            @this.set('prices.{{$accessory->id}}', response.data['offerppssNormal']);
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
            }

            )

    };
    };
    $('#{{$accessory->slug}} select').on('change', countSelected{{$accessory->id}});
    @endif
    @endforeach
</script>
@endpush
