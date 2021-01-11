<?php

namespace App\Http\Livewire;

use App\Coupon;
use App\Setting;
use App\Shipping_methods;
use App\User;
use Cart;
use Livewire\Component;
use App\Services\Shipping;
use Illuminate\Http\Request;

class CartPage extends Component
{
    // items selected
    public $items = [];
    // calc subtotal
    public $subTotal = 0;
    // calc total
    public $total = 0;
    // shipping cost
    public $shipping = 0;
    // shipping methods
    public $shippings = [];
    // country selected to calc shipping
    public $country;
    // default shipping method (setting)
    public $defaultShipping;

    public $disabled = false;
    // coupon calc
    public $coupon = '';
    // message (error)
    public $message = '';
    // message success
    public $success = '';
    // when check all items
    public $checkAll = false;

    public $carts  = [];

    public function mount()
    {
        $this->country = (session('country')) ? session('country') : '';
        $this->carts   = Cart::content();
        $setting       = config('app.setting');

        if($setting && $setting->default_shipping == 1 && $setting->shipping !== null) {
            $country_id            = $this->country;
            $this->defaultShipping = $setting->shipping->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                $q->whereHas('countries', function ($query) use ($country_id) {
                    $query->where('id', $country_id);
                });
            })->first();
        }
        foreach ($this->carts as $cart) {
            $cart_product               = $cart->getProduct();
            $method                     = $cart_product->methods->first();
            $this->shippings[$cart->id] = ($method)?$method->id:($this->defaultShipping) ? $this->defaultShipping->id : '';
        }
    }

    public function render()
    {

        $this->subTotal = 0;
        $this->shipping = 0;

        $stores = [];
        $unknown_stores = [];

        foreach ($this->carts as $cart) {
            $cart_product = $cart->getProduct();
            if (!in_array($cart_product->store, $stores)) {
                (!blank($cart_product->store)) ? array_push($stores, $cart_product->store) : array_push($unknown_stores, $cart);
            }
        }
        // check if items not empty
        if (count(array_filter($this->items)) > 0 && is_array($this->items)) {
            $this->disabled = false;
            // loop cart items
            foreach ($this->carts as $cart) {
                // check if cart in items array
                if (in_array($cart->id, $this->items)) {
                    // calc subtotal
                    $this->subTotal += $cart->price * $cart->quantity;
                }
            }
        } else {
            $this->disabled = true;
        }
        // check if shippings methods is not empty
        if ($this->shippings && is_array($this->shippings)) {
            $this->shipping = 0;
            // loop shipping methods
            foreach ($this->shippings as $index => $shipping) {
                // check if key in items array
                if (in_array($index, $this->items)) {
                    $cart = $this->carts->find($index);
                    $cart_product = $cart->getProduct();
                    $this->shipping += floatVal($cart_product->calcShipping(Shipping_methods::find($shipping), $cart->quantity));

                }
            }
        }
        // calc total (subtotal + shipping cost)
        $this->total = $this->subTotal + $this->shipping;
        return view('livewire.cart-page', ['stores' => $stores, 'unknown_stores' => $unknown_stores]);
    }

    // change cart quantity
    public function changeCart($qty, $id)
    {
        if (is_numeric($qty) && $qty && is_numeric($id) && $id) {
            Cart::update($id, $qty);
        }
    }
    // remove item from cart
    public function removeCart($id)
    {
        if (is_numeric($id) && $id) {
            Cart::remove($id);
            $this->emit('cartAdded');
        }
    }

    // select country to calc shipping cost
    public function SelectCountry()
    {
        // validate the country id
        $validatedData = $this->validate([
            'country' => 'required|numeric|min:1|exists:countries,id',
        ], [], [
            'country' => trans('admin.country'),
        ]);
        // if items empty
        if (count(array_filter($this->items)) == 0) {
            // error message
            \Session::flash('select', trans('user.please_select_some_products'));
        } else {
            // if items array  not empty check if shippings not empty
            if ($this->shippings && is_array($this->shippings)) {
                $this->shipping = 0;

                foreach ($this->carts as $cart) {
                    $cart_product = $cart->getProduct();
                    // loop product methods
                    foreach ($cart_product->methods as $method_index => $method) {
                        // loop shippings method array
                        foreach ($this->shippings as $index => $shipping) {
                            // check if shipping method key in selected items
                            if (in_array($index, $this->items)) {
                                // check if this method == this shipping
                                if ($method->id == $this->shippings[$cart->id]) {
                                    $this->shippings[$cart->id] = $method->id;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function updatedCountry()
    {
        // loop cart items
        foreach ($this->carts as $cart) {
            $cart_product = $cart->getProduct();
            $country_id = $this->country;
            // get all method for this product where has this country
            $method_countries = $cart_product->methods()->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                $q->whereHas('countries', function ($query) use ($country_id) {
                    $query->where('id', $country_id);
                });
            })->get();
            // if $method_countries empty
            if (count($method_countries) <= 0) {
                // will get the default shipping method if has this country
                $defaultShipping = Setting::orderBy('id', 'desc')->first();
                if ($defaultShipping->default_shipping == 1) {
                    if ($defaultShipping->shipping !== null) {
                        $isDefaultMethod = $defaultShipping->shipping()->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                            $q->whereHas('countries', function ($query) use ($country_id) {
                                $query->where('id', $country_id);
                            });
                        })->first();
                        // push $defaultShipping to shippings array
                        if ($isDefaultMethod !== null) {
                            $this->shippings[$cart->id] = $defaultShipping->shipping->id;
                        } else {
                            // if $defaultShipping empty remove this item from items array
                            $this->items[$cart->id] = null;
                        }

                    }
                }
                // if $defaultShipping empty remove this item from items array
                if ($defaultShipping->default_shipping != 1 || $defaultShipping->shipping == null) {
                    $this->items[$cart->id] = null;
                }
            } else {
                foreach ($method_countries as $method_index => $method) {
                    if ($method_index === 0) {
                        $this->shippings[$cart->id] = $method->id;
                        break;
                    }
                }
            }
        }
    }

    public function CheckCoupon()
    {
        $data = $this->validate([
            'coupon' => 'required|string',
        ], [], [
            'coupon' => trans('admin.coupon'),
        ]);

        $promocode = Coupon::where('code', $data['coupon'])->first();
        if ($promocode->rules === 'all_users' || $promocode->rules === 'specific_user' && $promocode->user_id === auth()->user()->id) {

            try {
                \Promocodes::check($data['coupon']);
                try {
                    if (\Promocodes::redeem($data['coupon'])) {
                        $coupon = \App\Coupon::where('code', $data['coupon'])->first();
                        session()->push('coupon', ['reward' => $coupon->reward, 'is_usd' => $coupon->is_usd]);
                        $this->message = '';
                        $this->success = trans('user.Add_successfuly');
                        $this->coupon = '';
                    } else {
                        $this->message = trans('user.Invalid_promotion_code_was_passed');
                        $this->success = '';
                    }
                } catch (\Gabievi\Promocodes\Exceptions\AlreadyUsedException $e) {
                    $this->message = trans('user.coupon_is_already_used_by_current_user');
                    $this->success = '';
                } catch (\Gabievi\Promocodes\Exceptions\UnauthenticatedException $e) {
                    $this->success = '';
                    $this->message = trans('user.please_sign_in_to_can_use_your_coupon');
                }
            } catch (\Gabievi\Promocodes\Exceptions\InvalidPromocodeException $e) {
                $this->success = '';
                $this->message = trans('user.Invalid_promotion_code_was_passed');
            }
        } else {
            $this->success = '';
            $this->message = trans('user.Invalid_promotion_code_was_passed');
        }
    }

    public function proceed_to_checkout()
    {
        // add cart and shipping selected to session to proceed
        if (count(array_filter($this->items)) > 0) {
            session()->forget('items');

            foreach ($this->items as $item) {
                if (!empty($item)) {
                    session()->push('items', ['item' => $item, 'shipping' => $this->shippings[$item]]);
                }
            }
            return redirect()->route('show_checkout');
        }
    }

    public function updatedCheckAll()
    {
        if ($this->checkAll) {

            $country_id = $this->country;
            if ($country_id) {
                foreach ($this->carts as $cart) {
                    $cart_product = $cart->getProduct();

                    // get all method for this product where has this country
                    $method_countries = $cart_product->methods()->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                        $q->whereHas('countries', function ($query) use ($country_id) {
                            $query->where('id', $country_id);
                        });
                    })->get();

                    // if $method_countries empty
                    if (count($method_countries) <= 0) {
                        // will get the default shipping method if has this country
                        $defaultShipping = Setting::orderBy('id', 'desc')->first();
                        if ($defaultShipping->default_shipping == 1) {
                            if ($defaultShipping->shipping !== null) {
                                $isDefaultMethod = $defaultShipping->shipping()->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                                    $q->whereHas('countries', function ($query) use ($country_id) {
                                        $query->where('id', $country_id);
                                    });
                                })->first();
                                // if $defaultShipping == null remove this item from items array
                                if ($isDefaultMethod !== null) {
                                    $this->shippings[$cart->id] = $defaultShipping->shipping->id;
                                    $this->items[$cart->id] = $cart->id;
                                } else {
                                    $this->items[$cart->id] = null;
                                }

                            }
                        }
                        // if $defaultShipping empty remove this item from items array

                        if ($defaultShipping->default_shipping != 1 || $defaultShipping->shipping == null) {
                            $this->items[$cart->id] = null;
                        }
                    } else {
                        foreach ($method_countries as $method_index => $method) {
                            if ($method_index === 0) {
                                $this->shippings[$cart->id] = $method->id;
                                $this->items[$cart->id] = $cart->id;
                                break;
                            }
                        }
                    }
                }
            }
        } else {
            $this->items = [];
        }
    }


    public function isMethod($cart_product)
    {
        $country_id       = $this->country;
        $isMethod         = [];
        $isDefaultMethod;
        if ($country_id) {
            $isMethod = $cart_product->methods()->where('status', 0)->whereHas('zone', function ($query) use ($country_id) {
                $query->whereHas('countries', function ($q) use ($country_id) {
                    $q->where('id', $country_id);
                });
            })->get();
            if (count($isMethod) <= 0) {
                $defaultShipping = config('app.setting');

                if ($defaultShipping->default_shipping == 1) {

                    if ($defaultShipping->shipping !== null) {
                        $isDefaultMethod = $defaultShipping->shipping()->where('status', 0)->whereHas('zone', function ($q) use ($country_id) {
                            $q->whereHas('countries', function ($query) use ($country_id) {
                                $query->where('id', $country_id);
                            });
                        })->get();
                    }
                }
            }
        }
        return (!blank($isMethod))? $isMethod : $isDefaultMethod;
    }

    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }


    public function validateShipping(User $user) {
        // Try and validate the address

        $shipping = new Shipping();
        $validate = $shipping->validateAddress($user);
        // Make sure it's not an invalid address this
        // could also be moved to a custom validator rule
        if ($validate->object_state == 'INVALID') {
            return back()->withMessages($validate->messages);
        }
    }


    public function changeShipping($formData, $id) {
        $request = new Request($formData);

        $validatedData = $request->validate([
            'radio'. $id => 'required|numeric|min:1',
        ], [], [
            'radio'. $id => trans('admin.radio'),
        ]);
        $this->shippings[$id] = $validatedData['radio'. $id];

    }
    /* public function shippingFromTo() {
        //add_filter ( 'woocommerce_cart_collaterals', 'lieferzeit');
//function lieferzeit() {

    $all_items_in_stock = true; // initializing

    // Iterating through cart items (to get the stock info)
    foreach ($this->carts as $cart_item) {
        // The cart item stock quantity

        if( $cart_item->buyable->stock <= 0 || $cart_item->buyable->in_stock == 'out_stock'){
            // if an item is out of stock
            $all_items_in_stock = false;
            break; // We break the loop
        }
    }

    // Items "in stock" (1 to 4 week days)
    if( $all_items_in_stock ){
        for( $start=0, $count=-1 ; $count < 4; $start++ ){
            $weekdays = date('w', strtotime("+$start days"));
            if( $weekdays > 0 && $weekdays < 6 ){
                $count++;
            //echo date('D j (w)', strtotime("+$start days")).', ';
                if($count == 1){
                    $from = date('D. j/n', strtotime("+$start days") );
                } elseif($count == 4) {
                    $to = date('D. j/n', strtotime("+$start days") );
                }
            }
        }
    } else { // 1 is Items Out of stock (14 to 21 week days)
        for( $start=0, $count=-1 ; $count < 21; $start++ ){
            $weekdays = date('w', strtotime("+$start days"));
            if( $weekdays > 0 && $weekdays < 6 ){
                $count++;
                if($count == 14){
                    $from = date('D. j/n', strtotime("+$start days") );
                } elseif($count == 21) {
                    $to = date('D. j/n', strtotime("+$start days") );
                }
            }
        }
    }
    ## TRANSLATION ##

    // DAYS IN ENGLISH (Source)
    //$days_en = array('Mon','Tue','Wed','Thu','Fri');

    // TRANSLATE the DAYS in GERMAN (replacement)
    //$days_ge = array('Mmm','Ttt','Www','Thh','Fff');

    //$from = str_replace( $days_en, $days_ge, $from );
    //$to = str_replace( $days_en, $days_ge, $to );

    ## OUTPUT ##

    echo "Estimated shipping $from - $to";
//}
    } */
}
