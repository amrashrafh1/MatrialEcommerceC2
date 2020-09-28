<?php

namespace App\Http\Controllers\FrontEnd;

use App\Attribute;
use App\Order;
use App\DataTables\sellers\OrdersDatatable;
use App\DataTables\sellers\ProductsDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\productsRequestStore;
use App\Product;
use App\Shipping_methods;
use App\Variation;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $path = 'products';
    public function __construct()
    {
        $this->middleware(['auth','role:seller']);
    }

    public function index()
    {
        return view('FrontEnd.sellers.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products(ProductsDatatable $datatable)
    {
        return $datatable->render('FrontEnd.sellers.seller-products');
    }

    public function create()
    {
        $validatorCategoryForm = \JsValidator::make([
            'sku'            => 'required|string|max:191|unique:products',
            'slug'           => 'required|string|max:191|unique:products',
            'product_type'   => 'required|string',
            'purchase_price' => 'required|numeric',
            'sale_price'     => 'required|numeric',
            'in_stock'       => 'required|string',
            'tradmark_id'    => 'required|numeric',
            'stock'          => 'required|numeric',
            'visible'        => 'required|string|max:191',
            'tax'            => 'required|numeric',
            'category_id'    => 'required|numeric',
            'image'          => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'description_en' => 'sometimes|nullable|string',
            'length_en'      => 'sometimes|nullable|max:191',
            'width_en'       => 'sometimes|nullable|max:191',
            'height_en'      => 'sometimes|nullable|max:191',
            'weight_en'      => 'sometimes|nullable|max:191',
            'name_en'        => 'required|string|max:191',
            'size_en'        => 'sometimes|nullable|string',
            'color_en'       => 'sometimes|nullable|string',
            'shippings'      => 'required',
        ]);
        return view('FrontEnd.sellers.products.create', [
            'Validator' => $validatorCategoryForm,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(productsRequestStore $request)
    {
        $shippings = $this->validate(request(), [
            'shippings.*' => 'required|numeric',
        ], [], [
            'shippings' => trans('admin.shippings'),
        ]);
        $img = '';
        if (!empty($request['image'])) {
            $img = upload($request['image'], $this->path);
        }

        $product = Product::create([
            'sku'              => $request['sku'],
            'section'          => 'none',
            'product_type'     => $request['product_type'],
            'purchase_price'   => $request['purchase_price'],
            'sale_price'       => $request['sale_price'],
            'in_stock'         => $request['in_stock'],
            'tradmark_id'      => $request['tradmark_id'],
            'owner'            => 'for_seller',
            'user_id'          => auth()->user()->id,
            'stock'            => $request['stock'],
            'visible'          => $request['visible'],
            'tax'              => $request['tax'],
            'category_id'      => $request['category_id'],
            'image'            => $img,
            'approved'         => 0,
            'description'      => $request['description_en'],
            'slug'             => \Str::slug($request['slug']),
            'length'           => (empty($request['length'])) ? null : $request['length'],
            'width'            => (empty($request['width'])) ? null : $request['width'],
            'height'           => (empty($request['height'])) ? null : $request['height'],
            'weight'           => (empty($request['weight'])) ? null : $request['weight'],
            'name'             => $request['name_en'],
            'size'             => (empty($request['size_en'])) ? null : $request['size_en'],
            'color'            => (empty($request['color_en'])) ? null : $request['color_en'],
            'has_accessories'  => $request['has_accessories'],
            'meta_tag'         => (empty($request['meta_tag_en'])) ? null : $request['meta_tag_en'],
            'meta_description' => (empty($request['meta_description_en'])) ? null : $request['meta_description_en'],
            'meta_keyword'     => (empty($request['meta_keyword_en'])) ? null : $request['meta_keyword_en'],
        ]);
        if (!empty($request['tags_en'])) {
            $data_en = explode(',', $request['tags_en']);
            foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                ($localeCode == 'en') ? '' : ${'data_' . $localeCode} = explode(',', $request['tags_' . $localeCode]);
            }
            foreach ($data_en as $index => $att) {
                $product->attachTag($att);
                $tag = \Spatie\Tags\Tag::findOrCreate($att);
                foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    if ($localeCode != 'en') {
                        if (!empty(${'data_' . $localeCode}[$index])) {
                            $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                        }
                    }
                }
            }
        }
        foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $product->setTranslation('name', $localeCode, $request['name_' . $localeCode])->save();
            (empty($request['description_' . $localeCode])) ?: $product->setTranslation('description', $localeCode, $request['description_' . $localeCode])->save();
            (empty($request['size_' . $localeCode])) ?: $product->setTranslation('size', $localeCode, $request['size_' . $localeCode])->save();
            (empty($request['color_' . $localeCode])) ?: $product->setTranslation('color', $localeCode, $request['color_' . $localeCode])->save();
            (empty($request['meta_tag_' . $localeCode])) ?: $product->setTranslation('meta_tag', $localeCode, $request['meta_tag_' . $localeCode])->save();
            (empty($request['meta_description_' . $localeCode])) ?: $product->setTranslation('meta_description', $localeCode, $request['meta_description_' . $localeCode])->save();
            (empty($request['meta_keyword_' . $localeCode])) ?: $product->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_' . $localeCode])->save();

        };
        if ($request['product_type'] == 'variable') {
            $product->attributes()->attach($request['attributes']);

        }
        $product->methods()->attach($shippings['shippings']);
        if (!empty($request['gallery'])) {
            multiple_uploads($request['gallery'], $this->path, 'App\Product', $product->id, 600, 350);
        }
        \Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route('seller_frontend_products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if ($rows) {
            $validatorCategoryForm = \JsValidator::make([
                'sku'            => 'sometimes|required|string|max:191|unique:products,sku,' . $rows->id,
                'slug'           => 'sometimes|required|string|max:191|unique:products,slug,' . $rows->id,
                'product_type'   => 'required|string',
                'purchase_price' => 'required|numeric',
                'sale_price'     => 'required|numeric',
                'in_stock'       => 'required|string',
                'tradmark_id'    => 'required|numeric',
                'stock'          => 'required|numeric',
                'visible'        => 'required|string|max:191',
                'tax'            => 'required|numeric',
                'category_id'    => 'required|numeric',
                'image'          => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:products,image,' . $rows->id,
                'description_en' => 'sometimes|nullable|string',
                'length_en'      => 'sometimes|nullable|max:191',
                'width_en'       => 'sometimes|nullable|max:191',
                'height_en'      => 'sometimes|nullable|max:191',
                'weight_en'      => 'sometimes|nullable|max:191',
                'name_en'        => 'required|string|max:191',
                'size_en'        => 'sometimes|nullable|string',
                'color_en'       => 'sometimes|nullable|string',
                'shippings'      => 'sometimes|nullable',
            ]);

            $attributes = $rows->attributes;
            $ids = [];
            foreach ($attributes as $val) {
                array_push($ids, $val->id);
            }
            $newAttributes = Attribute::whereNotIn('id', $ids)->select('name', 'id')->get();
            $zones = Shipping_methods::select('name', 'id', 'zone_id', 'company_id')->with('zone:id,name')->with('shippingcompany:id,name')->get();
            $methods = $rows->methods()->with('zone:id,name')->with('shippingcompany:id,name')->get();

        } else {
            return redirect()->route('seller_dashboard');
        }
        return view('FrontEnd.sellers.products.edit', ['methods' => $methods, 'rows' => $rows,
            'data' => $zones, 'attributes' => $newAttributes,
            'values' => $attributes, 'Validator' => $validatorCategoryForm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if ($rows) {
            $data = $this->validate(request(), [
                'sku'                  => 'sometimes|required|string|max:191|unique:products,sku,' . $rows->id,
                'slug'                 => 'sometimes|required|string|max:191|unique:products,slug,' . $rows->id,
                'section'              => 'sometimes|nullable|string',
                'product_type'         => 'required|string',
                'purchase_price'       => 'required|numeric',
                'sale_price'           => 'required|numeric',
                'in_stock'             => 'required|string',
                'tradmark_id'          => 'required|numeric',
                'stock'                => 'required|numeric',
                'visible'              => 'required|string|max:191',
                'tax'                  => 'required|numeric',
                'category_id'          => 'required|numeric',
                'image'                => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:products,image,' . $rows->id,
                'gallery.*'            => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
                'description_en'       => 'sometimes|nullable|string',
                'short_description_en' => 'sometimes|nullable|string|max:255',
                'tags_en'              => 'sometimes|nullable|max:191',
                'user_id'              => 'sometimes|nullable|numeric',
                'owner'                => 'sometimes|nullable|in:for_seller,for_site_owner',
                'length_en'            => 'sometimes|nullable|max:191',
                'width_en'             => 'sometimes|nullable|max:191',
                'height_en'            => 'sometimes|nullable|max:191',
                'weight_en'            => 'sometimes|nullable|max:191',
                'name_en'              => 'required|string|max:191',
                'size_en'              => 'sometimes|nullable|string',
                'color_en'             => 'sometimes|nullable|string',
                'shippings'            => 'required',
                'attributes.*'         => 'sometimes|nullable|numeric|max:191',
                'has_accessories'      => 'required|string|max:191',
                'meta_tag_en'          => 'sometimes|nullable|string',
                'meta_description_en'  => 'sometimes|nullable|string',
                'meta_keyword_en'      => 'sometimes|nullable|string',
            ]);
            $shippings = $this->validate(request(), [
                'shippings.*' => 'sometimes|nullable|numeric',

            ], [], [
                'shippings' => trans('admin.shippings'),
            ]);
            $img = '';
            if (!empty($request['image'])) {
                $image = $rows->image;
                \Storage::delete($image);
                $img = upload($request['image'], $this->path);
            } else {
                $img = $rows->image;
            }
            $rows->update([
                'sku'              => $request['sku'],
                'section'          => 'none',
                'product_type'     => $request['product_type'],
                'purchase_price'   => $request['purchase_price'],
                'sale_price'       => $request['sale_price'],
                'in_stock'         => $request['in_stock'],
                'tradmark_id'      => $request['tradmark_id'],
                'stock'            => $request['stock'],
                'visible'          => $request['visible'],
                'tax'              => $request['tax'],
                'owner'            => 'for_seller',
                'user_id'          => auth()->user()->id,
                'category_id'      => $request['category_id'],
                'image'            => $img,
                //'description'      => $request['description_en'],
                'slug'             => \Str::slug($request['slug']),
                'length'           => (empty($request['length'])) ? null : $request['length'],
                'width'            => (empty($request['width'])) ? null : $request['width'],
                'height'           => (empty($request['height'])) ? null : $request['height'],
                'weight'           => (empty($request['weight'])) ? null : $request['weight'],
                //'name'             => $request['name_en'],
                //'size'             => (empty($request['size_en'])) ? null : $request['size_en'],
               // 'color'            => (empty($request['color_en'])) ? null : $request['color_en'],
                'has_accessories'  => $request['has_accessories'],
                //'meta_tag'         => (empty($request['meta_tag_en'])) ? null : $request['meta_tag_en'],
                //'meta_description' => (empty($request['meta_description_en'])) ? null : $request['meta_description_en'],
                //'meta_keyword'     => (empty($request['meta_keyword_en'])) ? null : $request['meta_keyword_en'],
            ]);
            if (!empty($request['tags_en'])) {
                $data_en = explode(',', $request['tags_en']);
                foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    ($localeCode == 'en') ? '' : ${'data_' . $localeCode} = explode(',', $request['tags_' . $localeCode]);
                }
                $rows->syncTags($data_en);
                foreach ($data_en as $index => $att) {
                    $tag = \Spatie\Tags\Tag::findOrCreate($att);
                    foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                        if ($localeCode != 'en') {
                            if (!empty(${'data_' . $localeCode}[$index])) {
                                $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                            }
                        }
                    }
                }
            }

            foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $rows->setTranslation('name', $localeCode, $request['name_' . $localeCode])->save();
                (empty($request['description_' . $localeCode])) ?: $rows->setTranslation('description', $localeCode, $request['description_' . $localeCode])->save();
                (empty($request['size_' . $localeCode])) ?: $rows->setTranslation('size', $localeCode, $request['size_' . $localeCode])->save();
                (empty($request['color_' . $localeCode])) ?: $rows->setTranslation('color', $localeCode, $request['color_' . $localeCode])->save();
                (empty($request['meta_tag_' . $localeCode])) ?: $rows->setTranslation('meta_tag', $localeCode, $request['meta_tag_' . $localeCode])->save();
                (empty($request['meta_description_' . $localeCode])) ?: $rows->setTranslation('meta_description', $localeCode, $request['meta_description_' . $localeCode])->save();
                (empty($request['meta_keyword_' . $localeCode])) ?: $rows->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_' . $localeCode])->save();
            };
            if ($request['product_type'] === 'variable') {
                $rows->attributes()->sync($request['attributes']);
            } else {
                $rows->attributes()->detach($request['attributes']);
            }
            $rows->methods()->sync($shippings['shippings']);

            if (!empty($request['gallery'])) {
                multiple_uploads($request['gallery'], $this->path, 'App\Product', $rows->id, 600, 350);
            }
            \Alert::success(trans('admin.updated'), trans('admin.updated_record'));
        }
        return redirect()->route('seller_frontend_products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $row = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if ($row) {
            \Storage::delete($row->logo);
            \DB::table('cart_items')->where('buyable_id', $row->id)->delete();
            $row->delete();
            \Alert::success(trans('admin.updated'), trans('admin.updated_record'));
        }
        return redirect()->route('seller_frontend_products');
    }
    public function destory_all(Request $request)
    {
        if (request()->has('item') && $request->item != '') {
            if (is_array($request->item)) {
                foreach ($request->item as $d) {
                    $row = Product::where('slug', $d)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
                    if ($row) {
                        \Storage::delete($row->logo);
                        \DB::table('cart_items')->where('buyable_id', $row->id)->delete();
                        $row->delete();
                    }
                }
            } else {
                $row = Product::where('slug', $request->item)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
                if ($row) {
                    \Storage::delete($row->logo);
                    \DB::table('cart_items')->where('buyable_id', $row->id)->delete();
                    $row->delete();
                }
            }
            \Alert::success(trans('admin.updated'), trans('admin.updated_record'));
        }
        return redirect()->route('seller_frontend_products');
    }

    public function variations($slug)
    {
        if (Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first()
            ->variations->isEmpty()) {
            $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        } else {
            return $this->variations_edit($slug);
        }

        return view('FrontEnd.sellers.products.seller-products-variations', ['product' => $rows]);
    }
    public function variations_store(Request $request, $slug)
    {
        $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if ($rows) {

            $data = $this->validate(request(), [

                'sku.*'            => 'sometimes|nullable|unique:variations,sku',
                'sale_price.*'     => 'sometimes|nullable',
                'purchase_price.*' => 'sometimes|nullable',
                'stock.*'          => 'sometimes|nullable',
                'in_stock.*'       => 'required',
                'visible.*'        => 'required',
                'variations.*'     => 'required',
            ], [], [
                'sku'            => trans('admin.sku'),
                'sale_price'     => trans('admin.sale_price'),
                'purchase_price' => trans('admin.purchase_price'),
                'stock'          => trans('admin.stock'),
                'in_stock'       => trans('admin.in_stock'),
                'visible'        => trans('admin.visible'),
                'variations'     => trans('admin.variations'),

            ]);
            $variations = array_chunk($data['variations'], count($data['variations']) / count($data['in_stock']));
            foreach ($data['in_stock'] as $index => $clean) {
                $vars = $variations[$index];
                $variation = Variation::create([
                    'sku'            => (!empty($data['sku'][$index])) ? $data['sku'][$index] : null,
                    'sale_price'     => (!empty($data['sale_price'][$index])) ? $data['sale_price'][$index] : null,
                    'purchase_price' => (!empty($data['purchase_price'][$index])) ? $data['purchase_price'][$index] : null,
                    'stock'          => (!empty($data['stock'][$index])) ? $data['stock'][$index] : null,
                    'in_stock'       => $data['in_stock'][$index],
                    'visible'        => $data['visible'][$index],
                    'product_id'     => $rows->id,
                ]);
                foreach ($vars as $var) {
                    $variation->attributes()->attach($var);
                }
            }
        }
        return redirect()->route('seller_frontend_products');
    }

    public function variations_edit($slug)
    {
        $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        return view('FrontEnd.sellers.products.seller-products-variations-edit', ['rows' => $rows]);
    }

    public function variation_update(Request $request, $slug)
    {
        $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if ($rows) {
            $data = $this->validate(request(), [

                'sku.*'            => 'sometimes|nullable',
                'sale_price.*'     => 'sometimes|nullable',
                'purchase_price.*' => 'sometimes|nullable',
                'stock.*'          => 'sometimes|nullable',
                'in_stock.*'       => 'required',
                'visible.*'        => 'required',
                'variations.*'     => 'required',
                'variation_id.*'   => 'sometimes|nullable',
            ], [], [
                'sku'            => trans('admin.sku'),
                'sale_price'     => trans('admin.sale_price'),
                'purchase_price' => trans('admin.purchase_price'),
                'stock'          => trans('admin.stock'),
                'in_stock'       => trans('admin.in_stock'),
                'visible'        => trans('admin.visible'),
                'variations'     => trans('admin.variations'),
                'variation_id'   => trans('admin.variation_id'),

            ]);
            $variations = array_chunk($data['variations'], count($data['variations']) / count($data['in_stock']));
            foreach ($data['in_stock'] as $index => $clean) {
                $vars = $variations[$index];
//dd($vars);
                if (!empty($request['variation_id'][$index])) {
                    Variation::where('id', $request['variation_id'][$index])->update([
                        'sku'            => (!empty($data['sku'][$index])) ? $data['sku'][$index] : null,
                        'sale_price'     => (!empty($data['sale_price'][$index])) ? $data['sale_price'][$index] : null,
                        'purchase_price' => (!empty($data['purchase_price'][$index])) ? $data['purchase_price'][$index] : null,
                        'stock'          => (!empty($data['stock'][$index])) ? $data['stock'][$index] : null,
                        'in_stock'       => $data['in_stock'][$index],
                        'visible'        => $data['visible'][$index],
                        'product_id'     => $rows->id,
                    ]);
                    $variation = Variation::find($request['variation_id'][$index]);
                    $variation->attributes()->sync($vars);
                } else {
                    $variation = Variation::create([
                        'sku'            => (!empty($data['sku'][$index])) ? $data['sku'][$index] : null,
                        'sale_price'     => (!empty($data['sale_price'][$index])) ? $data['sale_price'][$index] : null,
                        'purchase_price' => (!empty($data['purchase_price'][$index])) ? $data['purchase_price'][$index] : null,
                        'stock'          => (!empty($data['stock'][$index])) ? $data['stock'][$index] : null,
                        'in_stock'       => $data['in_stock'][$index],
                        'visible'        => $data['visible'][$index],
                        'product_id'     => $rows->id,
                    ]);
                    foreach ($vars as $var) {
                        $variation->attributes()->attach($var);
                    }
                }
            }
        }
        return redirect()->route('seller_frontend_products');
    }

    public function accessories($slug)
    {
        $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
        if ($rows) {
            return view('FrontEnd.sellers.products.seller-products-accessories', ['product' => $rows]);

        } else {
            return redirect()->route('seller_frontend_products');

        }
    }

    public function orders(OrdersDatatable $datatable)
    {
        return $datatable->render('FrontEnd.sellers.orders.index');
    }
    public function orders_show($id)
    {
        try {

            $order = \App\Order::findOrFail($id);
        } catch(ModelNotFoundException $e) {
            return view('FrontEnd.sellers.dashboard')->withErrors(trans('user.order_not_found'));
        }
        return view('FrontEnd.sellers.orders.show', ['title' => trans('user.order'), 'rows'=> $order]);
    }

    public function export_invoice($id) {
        $order  = Order::findOrfail($id);
        $items  = [];
        foreach($order->order_lines->where('seller_id',auth()->user()->id) as $line) {
            $seller_model = \App\User::findOrFail($line->seller_id);
            //dd($seller->seller_info);

            $seller = new Party([
                'name'          => $seller_model->name,
                'phone'         => ($seller_model->seller_info)?$seller_model->seller_info->phone1:$seller_model->phone,
                'custom_fields' => [
                    'address' => ($seller_model->seller_info)?$seller_model->seller_info->address1:$seller_model->address,
                    'email'   => $seller_model->email,
                ],
            ]);
            array_push($items,
            (new InvoiceItem())->title($line->product)->pricePerUnit($line->price)->quantity($line->quantity));
        }

        $customer = new Party([
            'name'          => $order->billing_name,
            'address'       => $order->billing_address1,
            'custom_fields' => [
                'phone'        => $order->billing_phone,
                'email'        => $order->billing_email,
                'order number' => '#'.$order->id,
            ],
        ]);

        $notes = [
            'your multiline',
            'additional notes',
            'in regards of delivery or something else',
        ];
        $sitename = (\App\Setting::latest('id')->first())?\App\Setting::latest('id')->first()->sitename:config('app.APP_NAME');

        $notes = implode("<br>", $notes);

        $invoice = Invoice::make('receipt')
            ->series('BIG')
            ->sequence(667)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($seller)
            ->buyer($customer)
            ->date(now())

            ->dateFormat('m/d/Y')
            ->payUntilDays(14)
            ->currencySymbol('$')
            ->currencyCode('USD')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($sitename . '  ' . $order->billing_name)
            ->addItems($items)
            ->notes($notes)
             //->logo(\Storage::url(\App\Setting::latest('id')->first()->logo))
            // You can additionally save generated invoice to configured disk
            ->save('public');
           // dd($invoice);
           dd($invoice);
        $link = $invoice->url();
        // Then send email to party with link

        // And return invoice itself to browser or have a different view
        return $invoice->stream();
    }
}
