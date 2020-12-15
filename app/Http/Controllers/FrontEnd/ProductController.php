<?php

namespace App\Http\Controllers\FrontEnd;

use App\Attribute;
use App\Attribute_Family;
use App\Http\Controllers\Controller;
use App\Product;
use App\Setting;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->where('visible', 'visible')
            ->with(['tradmark', 'ratings' => function ($query) {
                $query->where('approved', 1);
            }, 'store', 'discount', 'tags', 'accessories' => function ($query) {
                $query->where('visible', 'visible')->where('in_stock', 'in_stock');
            }, 'attributes', 'variations', 'variations.attributes'])->first();

        if ($product) {
            views($product)->record();

            $setting = Setting::latest('id')->first();
            SEOTools::setTitle($product->name);
            SEOTools::setDescription($product->meta_description);
            SEOTools::opengraph()->setUrl(route('show_product', $product->slug));
            SEOTools::setCanonical(route('shop'));
            SEOTools::opengraph()->addProperty('type', 'site');
            SEOTools::twitter()->setSite($setting ? $setting->twitter : '');
            SEOTools::jsonLd()->addImage(\Storage::url($product->image));

            if (session()->get('recently_viewed') !== null) {
                if (!in_array($product->id, session()->get('recently_viewed'))) {
                    session()->push('recently_viewed', $product->id);
                }
            } else {
                session()->push('recently_viewed', $product->id);
            }
            return view('FrontEnd.single-product', ['product' => $product]);

            /* else */
        } else {

            return redirect()->route('home');
        }
    }

    public function get_data(Request $request)
    {
        $data = $this->validate(request(), [
            'data.*' => 'required|exists:attributes,id',
            'seq' => 'required|numeric|exists:products,id',
        ], [], [
            'data' => trans('admin.data'),
            'seq' => trans('admin.product_id'),
        ]);
        $id = $data['data'];
        $count = count($id);

        $product    = Product::where('id', $data['seq'])->with('variations', 'variations.attributes')->first();
        $selected   = $data['data'];
        $variations = $product->variations()->where('visible', 'visible');

        foreach ($selected as $id) {
            $variations->whereHas('attributes', function ($q) use ($id) {
                $q->where('id', $id);
            });
        }
        $variation = $variations->orderBy('id','desc')->first();

        if ($variation) {
            $price = ($variation->sale_price) ? $variation->calc_price() : $product->calc_price();
            $sale_price = $variation->calc_price();
            $sale = $variation->priceDiscount();
            return [
                'offerppss'       => (intval($sale) == 0) ? 0 : curr($sale),
                'offerppssNormal' => (intval($sale) == 0) ? 0 : $sale,
                'ppss'            => (intval($sale_price) == 0) ? 0 : curr($sale_price),
                'ppssNormal'      => (intval($sale_price) == 0) ? 0 : $sale_price,
                'offer'           => (intval($sale) == 0) ? 0 : curr($sale_price - $sale),
                'sku'             => ($variation->sku) ? $variation->sku : $product->sku,
                'stock'           => ($variation->stock) ? $variation->stock . ' ' . trans('user.' . $variation->in_stock) : $product->stock . ' ' . trans('user.' . $product->in_stock),
            ];
        }
        return response()->json(['message' => 'Not Found!'], 404);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function add_cart(Request $request, $slug)
    {
        $data = $this->validate(request(), [
            'quantity'     => 'required|numeric',
            'attributes.*' => 'required',
        ], [], [
            'quantity'   => trans('admin.quantity'),
            'attributes' => trans('admin.attributes'),
        ]);
        $product = Product::where('slug', $slug)->first();
        if ($product) {
            if ($product->isVariable()) {
                $attributes = $data['attributes'];
                $variations = $product->variations()->where('visible', 'visible')
                ->where('in_stock', 'in_stock');
                foreach ($attributes as $attribute) {
                    $variations->whereHas('attributes', function ($query) use ($attribute) {
                        $query->where('id', $attribute);
                    });
                }
                $result = $variations->orderBy('id','desc')->first();
                if ($result) {
                    $opts = [];
                    $attributes = Attribute::whereIn('id', $data['attributes'])->get();
                    foreach ($attributes as $attr) {
                        $family = Attribute_Family::where('id', $attr->family_id)->first();
                        if ($family) {
                            array_push($opts, [$family->name => $attr->id]);
                        }
                    }
                    $cart = \Cart::add($result, $data['quantity'], \Arr::collapse($opts));
                    Alert::success(trans('admin.added'), trans('admin.success_record'));
                    return redirect()->route('show_product', $product->slug);
                }
                Alert::warning(trans('admin.added'), trans('user.product_is_out_of_stock'));
                return redirect()->route('show_product', $product->slug);
            } else {
                \Cart::add($product, $data['quantity']);
                Alert::success(trans('admin.added'), trans('admin.success_record'));
            }
            return redirect()->route('show_product', $product->slug);
        }
        return redirect()->route('home');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function add_accesssories_cart(Request $request)
    {
        $data = $this->validate(request(), [
            'accessories.*' => 'required',
            'options.*' => 'required',
        ], [], [
            'accessories' => trans('admin.accessories'),
            'options' => trans('admin.options'),
        ]);
        if (isset($data['accessories'])) {
            $counter = 0;
            foreach ($data['accessories'] as $accessories) {

                $opts = [];
                $product = Product::where('id', $accessories)->first();
                if ($product) {

                    if (isset($data['options'][$product->id])) {
                        $opts = [];
                        $attributes = Attribute::whereIn('id', $data['options'][$product->id])->get();

                        if ($attributes) {

                            foreach ($attributes as $attr) {
                                $family = Attribute_Family::where('id', $attr->family_id)->first();
                                if ($family) {
                                    array_push($opts, [$family->name => $attr->name]);
                                }
                            }
                        }
                    }

                    \Cart::add($product, 1, \Arr::collapse($opts));
                    $opts = [];
                    Alert::success(trans('admin.added'), trans('admin.success_record'));
                } else {
                    \Cart::add($product, 1);

                }

            }
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
