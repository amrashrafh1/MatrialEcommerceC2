<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Setting;
class TagController extends Controller
{
    public function index($slug) {
        $tags      = \Spatie\Tags\Tag::where('slug->'.\LaravelLocalization::setLocale(),$slug)->where('type', 'products')->first();
        if($tags) {
            $setting             = Setting::latest('id')->first();

            SEOTools::setTitle($tags->name);
            SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
            SEOTools::opengraph()->setUrl(route('tags', $tags->slug));
            SEOTools::setCanonical(route('tags', $tags->slug));
            SEOTools::opengraph()->addProperty('type', 'site');
            SEOTools::twitter()->setSite($setting?$setting->twitter:'');
            SEOTools::jsonLd()->addImage($setting?\Storage::url($setting->image):'');

            return view('FrontEnd.tags', ['tags' => $tags]);
        }  else {
            return redirect()->route('home');
        }
    }
}
