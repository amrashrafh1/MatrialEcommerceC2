<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Setting;
use Artesaos\SEOTools\Facades\SEOTools;

class CategoryController extends Controller
{

    public function __invoke($slug) {
        $category = Category::where('slug', $slug)->with('products')->first();

        if($category) {
            $setting             = Setting::latest('id')->first();
            SEOTools::setTitle($category->name);
            SEOTools::setDescription($category->meta_description);
            SEOTools::opengraph()->setUrl(route('show_category', $category->slug));
            SEOTools::setCanonical(route('shop'));
            SEOTools::opengraph()->addProperty('type', 'site');
            SEOTools::twitter()->setSite($setting?$setting->twitter:'');
            SEOTools::jsonLd()->addImage(\Storage::url($category->image));
            views($category)->record();

            return view('FrontEnd.product-category', ['category' => $category]);
        } else {
            return redirect()->route('home');
        }
    }
}
