<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperDealController extends Controller
{
    public function index() {
        return view('FrontEnd.super-deal');
    }
}
