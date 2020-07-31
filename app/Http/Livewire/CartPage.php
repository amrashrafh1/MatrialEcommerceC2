<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\cartEvent;
use Illuminate\Http\Request;
class CartPage extends Component
{

    public $items     = [];
    public $subTotal  = 0;
    public $total     = 0;
    public $shipping  = 0;
    public $shippings = [];
    public $country;
    public $disabled = false;
    public $coupon   = '';
    public $message  = '';
    public $success  = '';
    public $checkAll = false;

    public function render()
    {
        $this->subTotal = 0;
        $this->shipping = 0;

        if(count( array_filter( $this->items)) > 0 && is_array($this->items)) {
            $this->disabled = false;
            foreach(\Cart::content() as $cart) {
                if(in_array($cart->id, $this->items)) {
                    $this->subTotal += $cart->price * $cart->quantity;
                }
            }
        } else {
            $this->disabled = true;
        }
        if($this->shippings && is_array($this->shippings)) {
            $this->shipping = 0;
             foreach($this->shippings as $index => $shipping) {
                 if(in_array($index, $this->items)) {
                     $this->shipping += floatVal(\Cart::content()->find($index)->buyable->calcShipping(\App\Shipping_methods::find($shipping), \Cart::content()->find($index)->quantity));

                 }
             }
         }

        $this->total = $this->subTotal + $this->shipping;
        return view('livewire.cart-page');
    }


    public function changeCart($qty,$id) {
        if(is_numeric($qty) && $qty && is_numeric($id) && $id) {
            \Cart::update($id, $qty);
        }
    }

    public function removeCart($id) {
        if(is_numeric($id) && $id) {
            \Cart::remove($id);
            $this->emit('cartAdded');
        }
    }

    public function SelectCountry() {
        $validatedData = $this->validate([
            'country' => 'required|numeric|min:1|exists:countries,id',
        ], [], [
            'country' => trans('admin.country')
        ]);
        if(count( array_filter( $this->items)) == 0) {
            \Session::flash('select', trans('please select some products'));
        } else {
            if($this->shippings && is_array($this->shippings)) {
                $this->shipping = 0;
                foreach(\Cart::content() as $cart) {
                    foreach($cart->buyable->methods as $method_index => $method) {
                        foreach($this->shippings as $index => $shipping) {
                            if(in_array($index, $this->items)) {
                                if($method->id == $this->shippings[$cart->id]) {
                                    $this->shippings[$cart->id] = $method->id;
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function updatedCountry() {

        foreach(\Cart::content() as $cart) {
            $country_id = $this->country;
            $method_countries = $cart->buyable->methods()->whereHas('zone',function ($q) use ($country_id){
                $q->whereHas('countries', function ($query) use ($country_id) {
                    $query->where('id',$country_id);
                });
            })->get();
            if(count($method_countries) <= 0) {

                $defaultShipping = \App\Setting::orderBy('id','desc')->first();
                if($defaultShipping->default_shipping == 1) {
                    if($defaultShipping->shipping !== null) {
                        $isDefaultMethod = $defaultShipping->shipping()->whereHas('zone',function ($q) use ($country_id){
                            $q->whereHas('countries', function ($query) use ($country_id) {
                                $query->where('id',$country_id);
                            });
                        })->first();
                        if($isDefaultMethod !== null) {
                            $this->shippings[$cart->id] = $defaultShipping->shipping->id;
                        } else {
                            $this->items[$cart->id] = null;
                        }

                    }
                }
                if($defaultShipping->default_shipping != 1 || $defaultShipping->shipping == null) {
                    $this->items[$cart->id] = null;
                }
            } else {
                foreach($method_countries as $method_index => $method) {
                    if($method_index === 0) {
                        $this->shippings[$cart->id] = $method->id;
                    break;
                }
            }
        }
        }
    }


    public function CheckCoupon() {
        $data = $this->validate([
            'coupon' => 'required|string',
        ], [], [
            'coupon' => trans('admin.coupon')
        ]);


        try {
            \Promocodes::check($data['coupon']);
            try {
                if(\Promocodes::redeem($data['coupon'])) {
                    $coupon = \App\Coupon::where('code', $data['coupon'])->first();
                    session()->push('coupon', ['reward'=>$coupon->reward, 'is_usd' => $coupon->is_usd]);
                    $this->message = '';
                    $this->success = trans('user.Add_successfuly');
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
    }


    public function proceed_to_checkout() {
        // add cart and shipping selected to session to proceed
        if(count( array_filter( $this->items)) > 0) {
            session()->forget('items');
           // dd($this->items);
            foreach($this->items as $item) {
                if(!empty($item)) {
                    session()->push('items', ['item' => $item,'shipping' => $this->shippings[$item]]);
                }
            }
            return redirect(url('/checkout'));
        }
    }

    public function updatedCheckAll() {
        if($this->checkAll) {

        $country_id = $this->country;
        if($country_id) {

        foreach(\Cart::content() as $cart) {
            $method_countries = $cart->buyable->methods()->whereHas('zone',function ($q) use ($country_id){
                $q->whereHas('countries', function ($query) use ($country_id) {
                    $query->where('id',$country_id);
                });
            })->get();
            if(count($method_countries) <= 0) {

                $defaultShipping = \App\Setting::orderBy('id','desc')->first();
                if($defaultShipping->default_shipping == 1) {
                    if($defaultShipping->shipping !== null) {
                        $isDefaultMethod = $defaultShipping->shipping()->whereHas('zone',function ($q) use ($country_id){
                            $q->whereHas('countries', function ($query) use ($country_id) {
                                $query->where('id',$country_id);
                            });
                        })->first();
                        if($isDefaultMethod !== null) {
                            $this->shippings[$cart->id] = $defaultShipping->shipping->id;
                            $this->items[$cart->id] = $cart->id;
                        } else {
                            $this->items[$cart->id] = null;
                        }

                    }
                }
                if($defaultShipping->default_shipping != 1 || $defaultShipping->shipping == null) {
                    $this->items[$cart->id] = null;
                }
            } else {
                foreach($method_countries as $method_index => $method) {
                    if($method_index === 0) {
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
}
