<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index($slug) {
        $tags = \Spatie\Tags\Tag::where('slug->'.\LaravelLocalization::setLocale(),$slug)->first();
        return view('FrontEnd.tags', ['tags'=>$tags]);
    }
}
