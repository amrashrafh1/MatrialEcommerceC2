<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Setting;
class SuperDealController extends Controller
{
    public function index() {

        $setting             = Setting::latest('id')->first();

        SEOTools::setTitle('Super deals');
        SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('type', 'site');
        SEOTools::twitter()->setSite($setting?$setting->twitter:'');
        SEOTools::jsonLd()->addImage($setting?\Storage::url($setting->image):'');
        return view('FrontEnd.super-deal');
    }
}
