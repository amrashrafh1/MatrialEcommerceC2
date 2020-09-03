<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Product;
use App\Variation;
use App\Attribute;
use App\Attribute_Family;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;
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
        $product = Product::where('slug', $slug)->where('visible','visible')->first();
        if($product) {
        SEOTools::setTitle(($product->meta_tag)?$product->meta_tag:$product->name);
        SEOTools::setDescription(($product->meta_description)?$product->meta_description:$product->name);
        SEOTools::opengraph()->setUrl('http://current.url.com');
        SEOTools::setCanonical('https://codecasts.com.br/lesson');
        SEOTools::opengraph()->addProperty('type', 'store');
        SEOTools::twitter()->setSite('@LuizVinicius73');
        SEOTools::jsonLd()->addImage(\Storage::url($product->image));

        visits($product)->increment();

        if(session()->get('recently_viewed') !== null) {
            if(!in_array($product->id, session()->get('recently_viewed'))) {
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



    public function get_data(Request $request) {
        $data = $this->validate(request(), [
            'data' => 'required|array',
            'ass'  => 'required|numeric',
        ],[],[
            'data' => trans('admin.data'),
            'ass'  => trans('admin.ass')
        ]);
        $id  = $data['data'];
        $count = count($id);
        $product = Product::find(intval($data['ass']));

        $attributes = \DB::table('attribute_variation')->whereIn('attribute_id',$id)
            ->select('variation_id')
            ->groupBy('variation_id')
            ->havingRaw('COUNT(variation_id) = '. $count)->get();
        $variations = Variation::whereIn('id', $attributes->pluck('variation_id'))
        ->where('product_id', $product->id)->where('visible','visible')->where('in_stock','in_stock')

       // ->where('sale_price' ,'!=', 0)
       // ->where('sale_price' ,'!=', null)
        ->orderBy('id','desc')->first();
        if($variations) {
            $price      = ($variations->sale_price)?$variations->sale_price:$product->sale_price;
            $sale_price = $variations->sale_price + ($product->tax * $price) / 100;
            $sale       = $variations->priceDiscount($product,($variations->sale_price)?$variations->sale_price:$product->sale_price);
            return [
                'offerppss'       => (intval($sale) == 0)?0:curr($sale),
                'offerppssNormal' => (intval($sale) == 0)?0:$sale,
                'ppss'            => (intval($sale_price) == 0)?0:curr($sale_price),
                'ppssNormal'      => (intval($sale_price) == 0)?0:$sale_price,
                'offer'           => (intval($sale) == 0)?0:curr($sale_price - $sale),
                'sku'             => $variations->sku
            ];
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function add_cart(Request $request, $slug)
    {
       // dd(\Cart::content());
        $data = $this->validate(request(),[
            'quantity'     => 'required|numeric',
            'attributes.*' => 'required',
            ], [],[
            'quantity'   => trans('admin.quantity'),
            'attributes' => trans('admin.attributes'),
        ]);
        $product = Product::where('slug', $slug)->first();
        if($product) {
        if($product->product_type === 'variable') {

            $opts = [];
            $attributes = Attribute::whereIn('id', $data['attributes'])->get();
            foreach($attributes as $attr) {
                $family = Attribute_Family::where('id', $attr->family_id)->first();
                if($family) {
                    array_push($opts, [$family->name => $attr->name]);
                }
            }
            //dd($opts);
            \Cart::add($product,$data['quantity'], \Arr::collapse($opts));
            Alert::success(trans('admin.added'), trans('admin.success_record'));
        } else {
            \Cart::add($product,$data['quantity']);
            Alert::success(trans('admin.added'), trans('admin.success_record'));
        }
            return redirect()->route('show_product', $product->slug);
        }

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
        $data = $this->validate(request(),[
            'accessories.*' => 'required',
            'options.*'     => 'required',
        ], [],[
            'accessories' => trans('admin.accessories'),
            'options' => trans('admin.options'),
            ]);
            if(isset($data['accessories'])) {
            $counter = 0;
            foreach($data['accessories'] as $accessories) {

            $opts = [];
            $product = Product::where('id', $accessories)->first();
            if($product) {

                    if(isset($data['options'][$product->id])) {
                    $opts = [];
                    $attributes = Attribute::whereIn('id', $data['options'][$product->id])->get();

                    if($attributes) {

                        foreach($attributes as $attr) {
                            $family = Attribute_Family::where('id', $attr->family_id)->first();
                            if($family) {
                                array_push($opts, [$family->name => $attr->name]);
                            }
                        }
                    }
                    }


                    \Cart::add($product,1,\Arr::collapse($opts));
                    $opts = [];
                Alert::success(trans('admin.added'), trans('admin.success_record'));
            } else {
                \Cart::add($product,1);

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
