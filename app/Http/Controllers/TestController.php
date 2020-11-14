<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Discount;
use App\Sold;
use Auth;
class TestController extends Controller
{
    public function index() {
        $time_start = $this->microtime_float();
        $user_id    = session('store');

        /* $total_sales = Sold::whereHas('product', function ($query) use($store_id) {
            $query->where('seller_id', $store_id);
        })->sum('sold'); */
        \App\Sold::whereDate('created_at', today())->whereHas('product', function ($query) use($user_id) {
            $query->where('seller_id', $user_id);
        })->sum('sold');

        $time_end = $this->microtime_float();
        $time     = $time_end - $time_start;

        return $time . ' seconds';
    }

    private function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}
