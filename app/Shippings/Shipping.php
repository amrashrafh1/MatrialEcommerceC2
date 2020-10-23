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
            $shipping_name        = $this->shipping->name;
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

            return quantity_based_per_order($this->shipping, $qty);

        } elseif ($this->shipping->rule === 'price_based_per_order') {

            return $this->shipping->value / 100 * $this->sale_price;

        } elseif ($this->shipping->rule === 'flat_rate_per_item') {

            return $this->shipping->value * $qty;

        } elseif ($this->shipping->rule === 'weight_based_per_item') {

            return (floatval($this->weight) * $qty) * $this->shipping->value;

        } elseif ($this->shipping->rule === 'weight_based_per_order') {

            return weight_based_per_order($this->weight, $this->shipping, $qty);

        } elseif ($this->shipping->rule === 'price_based_per_item') {

            return ($this->shipping->value / 100 * $this->sale_price) * $qty;
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
