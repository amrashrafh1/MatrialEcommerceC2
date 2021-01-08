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
use App\Category;
use App\Country;
use App\Shipping_methods;
use DB;
use App\Jobs\DeleteCartItems;
use App\Jobs\DestroyAllProducts;
use Treestoneit\ShoppingCart\Models\Cart;
use App\Conversation;
use App\Events\SendMesseges;
use App\Events\StatusEvent;
use Storage;
class TestController extends Controller
{
    public function index() {
        $time_start = $this->microtime_float();


        $time_end = $this->microtime_float();
        $time     = $time_end - $time_start;

        return $time . ' seconds';
    }

    private function microtime_float() {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }

}
