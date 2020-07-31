<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CheckoutPage extends Component
{

    public $coupon    = '';
    public $message   = '';
    public $success   = '';
    public $shippings = 0;
    public $total     = 0;
    public $subtotal  = 0;
    public $coupons  = 0;

    public function render()
    {
        $this->shippings = 0;
        $this->total     = 0;
        $this->subtotal  = 0;
        return view('livewire.checkout-page');
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
                    $this->coupon  = '';
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

/* public function updatedPayment() {
    return redirect()->route('show_checkout');
} */

}
