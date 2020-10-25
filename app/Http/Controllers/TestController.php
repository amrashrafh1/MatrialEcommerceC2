<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Discount;
class TestController extends Controller
{
    public function index() {
        $time_start = $this->microtime_float();

        $discountProducts = Discount::discountAvailable()
        ->where('daily', 'daily_deals')
        ->whereHas('product' , function ($query) {
            $query->where('visible', 'visible')->where('approved', 1)
            ->select('id','slug','product_type','image','name','sale_price');
        })->take(12)->get();

        
        $time_end = $this->microtime_float();
        $time     = $time_end - $time_start;

        return $time . 'seconds';
    }

    private function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}
