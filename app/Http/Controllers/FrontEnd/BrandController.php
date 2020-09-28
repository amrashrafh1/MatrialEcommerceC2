<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Tradmark;
class BrandController extends Controller
{
    public function index($slug)
    {

        $brand = Tradmark::where('slug', $slug)->first();
        if ($brand) {

            return view('FrontEnd.brand', ['brand' => $brand]);

        } else {

            return redirect()->route('home');
        }
    }
}
