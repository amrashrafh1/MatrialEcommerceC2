<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($slug) {
        $tags      = \Spatie\Tags\Tag::where('slug->'.\LaravelLocalization::setLocale(),$slug)->where('type', 'products')->first();
        if($tags) {
            return view('FrontEnd.tags', ['tags' => $tags]);
        }  else {
            return redirect()->route('home');
        }
    }
}
