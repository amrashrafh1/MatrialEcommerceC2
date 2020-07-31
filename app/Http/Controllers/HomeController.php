<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $categories = Category::select('name','id', 'slug','image')
        ->where('status', 1)->where('cat_id', NULL)->take(12)
        ->with('children:name,slug,cat_id')->get();
        $catalog = visits('\App\Category')->top(20);
        /* Category::select('name','id', 'slug','image')
        ->where('status', 1)->where('cat_id', NULL)->take(12)
        ->with('children:name,slug,cat_id')->get(); */

        //currency()->setUserCurrency('EUR');

        //$clientIP = $request->getClientIp();
       // $localCurrency = geoip('217.23.5.42')->getAttribute('country');
       // dd($localCurrency);
        //currency()->setUserCurrency('INR');

       //\Promocodes::create(1, 4.5,[],null,5);
       //\Promocodes::redeem('K3DC-P6XF');
//dd(\Promocodes::all());
        SEOTools::setTitle('Home');
        SEOTools::setDescription('This is my page description');
        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage('https://codecasts.com.br/img/logo.jpg');

        return view('FrontEnd.home', ['categories' => $categories,'catalog' => $catalog]);
    }


    public function search(Request $request) {
        $data = $this->validate(request(),[
            'search'      => 'required|string',
            'product_cat' => 'sometimes|nullable|exists:categories,id',
        ],[],[
            'search'      => trans('user.search'),
            'product_cat' => trans('user.category')
        ]);
        if(!empty($data['product_cat'])) {
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
