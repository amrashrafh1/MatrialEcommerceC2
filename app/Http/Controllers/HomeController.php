<?php

namespace App\Http\Controllers;

use App\Adz;
use App\Category;
use App\Product;
use App\Slider;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use App\Setting;
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $catalog       = Category::where('status', 1)->orderByViews()->get();
        $adzs          = Adz::available()->inRandomOrder('id')->get();
        $randomProduct = Product::with('discount')->isApproved()->orderBy('id','desc')->first();
        $sliders       = Slider::isActive()->get();
        $setting       = Setting::latest('id')->first();

        SEOTools::setTitle($setting?$setting->sitename:config('app.name'));
        SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
        SEOTools::opengraph()->setUrl(url('/'));
        SEOTools::setCanonical(url('/'));
        SEOTools::opengraph()->addProperty('type', 'site');
        SEOTools::twitter()->setSite($setting?$setting->twitter:'');
        SEOTools::jsonLd()->addImage($setting?\Storage::url($setting->image):'');

        return view('FrontEnd.home', [
            'catalog'       => $catalog,
            'advertizments' => $adzs,
            'sliders'       => $sliders,
            'randomProduct' => $randomProduct]);
    }

    public function search(Request $request)
    {
        $data = $this->validate(request(), [
            'search' => 'required|string',
            'product_cat' => 'sometimes|nullable|exists:categories,id',
        ], [], [
            'search' => trans('user.search'),
            'product_cat' => trans('user.category'),
        ]);
        if (!empty($data['product_cat'])) {
            $search     = $data['search'];
            $categories = Category::where('id', $data['product_cat'])->first();
            $id         = [];
            $id         = $categories->children->pluck('id')->toArray();
            array_push($id, $categories->id);
            $products = Product::whereIn('category_id', $id)->where('visible', 'visible')->where('name', 'like', '%' . $data['search'] . '%')
                ->orWhere('description', 'like', '%' . $data['search'] . '%')->paginate(20);
        } else {
            $products = Product::where('visible', 'visible')->where('name', 'like', '%' . $data['search'] . '%')
                ->orWhere('description', 'like', '%' . $data['search'] . '%')->paginate(20);
        }
        return view('FrontEnd.search', ['products' => $products]);
    }
}
