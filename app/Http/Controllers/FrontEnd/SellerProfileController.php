<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SellerInfo;
class SellerProfileController extends Controller
{
    public function show_seller($slug)
    {
        $store = SellerInfo::where('slug', $slug)->first();
        if($store) {
            return view('FrontEnd.seller-profile', ['store' => $store]);
        }
        return redirect()->route('home');
    }
}
