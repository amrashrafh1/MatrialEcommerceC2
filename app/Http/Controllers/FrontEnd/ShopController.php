<?php

namespace App\Http\Controllers\FrontEnd;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Facades\SEOTools;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $setting             = Setting::latest('id')->first();
        SEOTools::setTitle($setting?$setting->sitename:config('app.name'));
        SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('type', 'site');
        SEOTools::twitter()->setSite($setting?$setting->twitter:'');
        SEOTools::jsonLd()->addImage($setting?\Storage::url($setting->image):'');

        return view('FrontEnd.shop');
    }
}
