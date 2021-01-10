<?php

namespace App\Http\Livewire\FrontEnd;

use Livewire\Component;
use App\Coupon;
use App\Setting;
use App\Shipping_methods;
use Cart;
class CartPage extends Component
{

    protected $carts = [], $selectedCart = [], $selectedMethods = [], $total = 0, $shipping = 0, $coupon = 0, $country_id, $stores = [];


    public function mount() {
        $this->country_id = session('country');
        $this->carts      = Cart::content();
    }
    public function render()
    {

        return view('livewire.front-end.cart-page');
    }
}
