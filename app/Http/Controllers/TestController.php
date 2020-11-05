<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Discount;
use Auth;
class TestController extends Controller
{
    public function index() {
        $time_start = $this->microtime_float();

        $stores = (Auth::check())?auth()->user()->followee()
        ->with(['products'=> function ($query) {
            $query->where('visible', 'visible')->where('approved', 1)
            ->select('id','slug','product_type','user_id','owner','image','name','sale_price')->orderBy('id', 'desc')->take(20);
        }])
        ->inRandomOrder()->take(4)->get():[];

        foreach($stores as $store) {
            foreach($store->products as $product) {
                echo $product->name . '<br/>';
            }
        }


        $time_end = $this->microtime_float();
        $time     = $time_end - $time_start;

        return $time . ' seconds';
    }

    private function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}
