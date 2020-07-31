<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CMS;
class EventController extends Controller
{
    public function cms_show($slug) {
        $cms = CMS::where('slug', $slug)->where('start_at','<=', \Carbon\Carbon::now())->where('expire_at','>', \Carbon\Carbon::now())->first();
        if($cms) {
            return view('FrontEnd.cms.shop',['cms' => $cms]);
        } else {
            return  redirect()->route('home');
        }
    }
}
