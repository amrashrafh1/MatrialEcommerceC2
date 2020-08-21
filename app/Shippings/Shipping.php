<?php

namespace App\Shippings;

use App\Setting;

class Shipping
{

    protected $shipping_total = 0;
    protected $qty            = 0;
    protected $price          = 0;
    protected $weight         = null;
    protected $shipping       = null;
    protected $shipping_name  = null;

    public function __construct($shipping = null, $qty, $price, $weight = null)
    {
        $this->shipping = $shipping;
        $this->qty      = $qty;
        $this->price    = $price;
        $this->weight   = $weight;
    }

    public function shippingMethod()
    {
        if (!$this->shipping) {
            $this->settingMethod();
        } else {
            $ship                 = $this->calcShipping();
            $this->shipping_total = round($ship);
            $shipping_name        = $shipping_method->name;
        }

        return [
            $this->shipping_total,
            $this->shipping_name,
        ];
    }

    public function calcShipping()
    {

        if ($this->shipping->rule === 'flat_rate_per_order') {

            return $this->shipping->value;

        } elseif ($this->shipping->rule === 'quantity_based_per_order') {

            return $this->shipping->value * ($this->qty / $this->shipping->weight);

        } elseif ($this->shipping->rule === 'price_based_per_order') {

            return $this->shipping->value / 100 * $this->price;

        } elseif ($this->shipping->rule === 'flat_rate_per_item') {

            return $this->shipping->value * $this->qty;

        } elseif ($this->shipping->rule === 'weight_based_per_item') {

            return (floatval($weight) * $this->qty / $this->shipping->weight) * $this->shipping->value;

        } elseif ($this->shipping->rule === 'weight_based_per_order') {

            return (floatval($weight) * $this->qty / $this->shipping->weight) * $this->shipping->value;

        } elseif ($this->shipping->rule === 'price_based_per_item') {

            return ($this->shipping->value / 100 * $this->price) * $this->qty;
        }
    }

    public function settingMethod()
    {
        $setting = Setting::orderBy('id', 'desc')->first();
        if ($setting->default_shipping == 1) {
            if ($setting->shipping !== null) {
                $this->shipping       = $setting->shipping;
                $ship                 = $this->calcShipping();
                $this->shipping_total = round($ship);
                $this->shipping_name  = $setting->shipping->name;
            }
        }
    }
}
