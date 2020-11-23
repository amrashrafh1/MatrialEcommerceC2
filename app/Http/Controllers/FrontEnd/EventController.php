<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CMS;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Setting;
class EventController extends Controller
{
    public function cms_show($slug) {
        $cms = CMS::where('slug', $slug)->where('start_at','<=', \Carbon\Carbon::now())->where('expire_at','>', \Carbon\Carbon::now())->first();
        if($cms) {

            $setting             = Setting::latest('id')->first();
            SEOTools::setTitle($cms->name);
            SEOTools::setDescription($cms->meta_description);
            SEOTools::opengraph()->setUrl(route('cms_show', $cms->slug));
            SEOTools::setCanonical(route('cms_show', $cms->slug));
            SEOTools::opengraph()->addProperty('type', 'site');
            SEOTools::twitter()->setSite($setting?$setting->twitter:'');
            SEOTools::jsonLd()->addImage(\Storage::url($cms->image));
            views($cms)->record();

            return view('FrontEnd.cms.shop',['cms' => $cms]);
        } else {
            return  redirect()->route('home');
        }
    }
}
