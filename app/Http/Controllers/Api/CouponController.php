<?php

namespace App\Http\Controllers\Api;

use App\Coupon;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CouponsResource;

class CouponController extends Controller
{
    use ApiResponse;


    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function check($code)
    {
        $promocode = Coupon::where('code', $code)->first();
        if ($promocode->rules === 'all_users' || $promocode->rules === 'specific_user' && $promocode->user_id === auth()->user()->id) {

            try {
                \Promocodes::check($code);
                try {
                    if (\Promocodes::redeem($code)) {
                        $coupon = \App\Coupon::where('code', $code)->first();
                        session()->push('coupon', ['reward' => $coupon->reward, 'is_usd' => $coupon->is_usd]);

                        return $this->sendResult('Added successfully', new CouponsResource($promocode), null, true);

                    } else {
                        return $this->sendResult(trans('user.Invalid_promotion_code_was_passed'),
                            null, trans('user.Invalid_promotion_code_was_passed'), false);

                    }
                } catch (\Gabievi\Promocodes\Exceptions\AlreadyUsedException $e) {
                    return $this->sendResult(trans('user.coupon_is_already_used_by_current_user'),
                        null, trans('user.coupon_is_already_used_by_current_user'), false);
                } catch (\Gabievi\Promocodes\Exceptions\UnauthenticatedException $e) {
                    return $this->sendResult(trans('user.please_sign_in_to_can_use_your_coupon'),
                        null, trans('user.please_sign_in_to_can_use_your_coupon'), false);
                }
            } catch (\Gabievi\Promocodes\Exceptions\InvalidPromocodeException $e) {
                return $this->sendResult(trans('user.Invalid_promotion_code_was_passed'),
                    null, trans('user.Invalid_promotion_code_was_passed'), false);

            }
        } else {
            return $this->sendResult(trans('user.Invalid_promotion_code_was_passed'),
                null, trans('user.Invalid_promotion_code_was_passed'), false);
        }
    }
}
