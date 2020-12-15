<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\OnlineUsers;
use App\Charts\ProfitsChart;
use App\Charts\RevenuesChart;
use App\Http\Controllers\Controller;
use App\Sold;
use App\User;
use App\Product;
use DB;
use App\Jobs\DeleteCartItems;
use App\Jobs\DestroyAllProducts;
use Treestoneit\ShoppingCart\Models\Cart;
class TestController extends Controller
{
    public function index() {
        $time_start = $this->microtime_float();

        $product = Product::where('id',895)->with('variations', 'variations.attributes')->first();
        $selected = [3,6,9,15];
        $variations = $product->variations()->where('visible','visible');

        foreach($selected as $id) {
            $variations->whereHas('attributes', function($q) use ($id) {
                $q->where('id', $id);
            });
        }
        dd($variations->first());

        $time_end = $this->microtime_float();
        $time     = $time_end - $time_start;

        return $time . ' seconds';
    }

    private function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }
}
