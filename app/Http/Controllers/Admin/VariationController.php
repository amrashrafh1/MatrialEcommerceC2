<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Attribute_Family;
use App\Http\Controllers\Controller;
use App\Product;
use App\Variation;
use App\AttributeVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Attribute_Product;
class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        if(Product::find($id)->variations->isEmpty()) {
            $title = trans('admin.add_variations');
            $rows = Product::findOrFail($id);
        } else {
            return $this->edit($id);
        }

        return view('Admin.products.variations', ['rows' => $rows, 'title' => $title]);
    }

    /* ** This methods to create variations for all attributes **/
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {

        $data = $this->validate(request(),[

            'sku.*'            => 'sometimes|nullable|unique:variations,sku',
            'sale_price.*'     => 'sometimes|nullable',
            'purchase_price.*' => 'sometimes|nullable',
            'stock.*'          => 'sometimes|nullable',
            'in_stock.*'       => 'required',
            'visible.*'        => 'required',
            'variations.*'      => 'required'
        ],[],[
            'sku'            => trans('admin.sku'),
            'sale_price'     => trans('admin.sale_price'),
            'purchase_price' => trans('admin.purchase_price'),
            'stock'          => trans('admin.stock'),
            'in_stock'       => trans('admin.in_stock'),
            'visible'        => trans('admin.visible'),
            'variations'     => trans('admin.variations'),

        ]);
        $variations = array_chunk($data['variations'],count($data['variations']) / count($data['in_stock']));
        foreach($data['in_stock'] as $index => $clean) {
            $vars = $variations[$index];
            $variation = Variation::create([
                'sku'            => (!empty($data['sku'][$index]))?$data['sku'][$index]:NULL,
                'sale_price'     => (!empty($data['sale_price'][$index]))?$data['sale_price'][$index]:NULL,
                'purchase_price' => (!empty($data['purchase_price'][$index]))?$data['purchase_price'][$index]:NULL,
                'stock'          => (!empty($data['stock'][$index]))?$data['stock'][$index]:NULL,
                'in_stock'       => $data['in_stock'][$index],
                'visible'        => $data['visible'][$index],
                'product_id'     => $id
            ]);
            foreach($vars as $var) {
                $variation->attributes()->attach($var);
            }
        }
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = trans('admin.edit_variations');
        $rows = Product::findOrFail($id);
        return view('Admin.products.variations-edit', ['rows' => $rows, 'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),[

            'sku.*'            => 'sometimes|nullable',
            'sale_price.*'     => 'sometimes|nullable',
            'purchase_price.*' => 'sometimes|nullable',
            'stock.*'          => 'sometimes|nullable',
            'in_stock.*'       => 'required',
            'visible.*'        => 'required',
            'variations.*'     => 'required',
            'variation_id.*'   => 'sometimes|nullable'
        ],[],[
            'sku'            => trans('admin.sku'),
            'sale_price'     => trans('admin.sale_price'),
            'purchase_price' => trans('admin.purchase_price'),
            'stock'          => trans('admin.stock'),
            'in_stock'       => trans('admin.in_stock'),
            'visible'        => trans('admin.visible'),
            'variations'     => trans('admin.variations'),
            'variation_id'   => trans('admin.variation_id'),

        ]);
        $variations = array_chunk($data['variations'],count($data['variations']) / count($data['in_stock']));
        foreach($data['in_stock'] as $index => $clean) {
            $vars = $variations[$index];
            if(!empty($request['variation_id'][$index])) {
                Variation::where('id', $request['variation_id'][$index])->update([
                    'sku'            => (!empty($data['sku'][$index])) ? $data['sku'][$index] : NULL,
                    'sale_price'     => (!empty($data['sale_price'][$index])) ? $data['sale_price'][$index] : NULL,
                    'purchase_price' => (!empty($data['purchase_price'][$index])) ? $data['purchase_price'][$index] : NULL,
                    'stock'          => (!empty($data['stock'][$index])) ? $data['stock'][$index] : NULL,
                    'in_stock'       => $data['in_stock'][$index],
                    'visible'        => $data['visible'][$index],
                    'product_id'     => $id
                ]);
                    $variation = Variation::find($request['variation_id'][$index]);
                    $variation->attributes()->sync($vars);
            } else {
                $variation = Variation::create([
                    'sku'            => (!empty($data['sku'][$index])) ? $data['sku'][$index] : NULL,
                    'sale_price'     => (!empty($data['sale_price'][$index])) ? $data['sale_price'][$index] : NULL,
                    'purchase_price' => (!empty($data['purchase_price'][$index])) ? $data['purchase_price'][$index] : NULL,
                    'stock'          => (!empty($data['stock'][$index])) ? $data['stock'][$index] : NULL,
                    'in_stock'       => $data['in_stock'][$index],
                    'visible'        => $data['visible'][$index],
                    'product_id'     => $id
                ]);
                foreach($vars as $var) {
                    $variation->attributes()->attach($var);
                }
            }
        }
        return redirect()->route('products.index');
    }

}
