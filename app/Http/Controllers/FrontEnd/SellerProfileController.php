<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
class SellerProfileController extends Controller
{
    public function show_seller($id)
    {
        $seller = User::where('id',$id)->whereRoleIs('seller')->first();
        if($seller) {

            return view('FrontEnd.seller-profile', ['seller' => $seller]);
        }
        return redirect()->route('home');
    }
}
