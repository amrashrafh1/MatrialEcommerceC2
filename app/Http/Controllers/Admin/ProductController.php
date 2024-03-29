<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\DataTables\ProductDataTable;
use App\DataTables\SellerProductsDatatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\productsRequestStore;
use App\Http\Requests\Admin\Products\productsRequestUpdate;
use App\inventory;
use App\Product;
use App\SellerInfo;
use App\Shipping_methods;
//use Illuminate\Support\Facades\Cache;
use DB;
use Illuminate\Http\Request;
use Image;
use LaravelLocalization;
use RealRashid\SweetAlert\Facades\Alert;
use App\Jobs\DeleteCartItems;
use App\Jobs\DestroyAllProducts;
class ProductController extends Controller
{
    protected $model = '';
    protected $path  = 'products';
    protected $route = 'products';

    public function __construct()
    {
        $this->middleware(['permission:read-' . $this->path])->only('index');
        $this->middleware(['permission:create-' . $this->path])->only('create');
        $this->middleware(['permission:update-' . $this->path])->only('edit');
        $this->middleware(['permission:delete-' . $this->path])->only('destroy');
        $this->model = Product::class;
       // $this->middleware('image-sanitize');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('Admin.' . $this->path . '.index', ['title' => $this->path . ' Table']);
    }

    public function sellers(SellerProductsDatatable $datatable)
    {
        return $datatable->render('Admin.products.seller-products', ['title' => 'Sellers products Table']);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $validatorCategoryForm = \JsValidator::make([
            'sku'                  => 'required|string|max:191|unique:products',
            'slug'                 => 'required|string|max:191|unique:products',
            'section'              => 'sometimes|nullable|string',
            'product_type'         => 'required|string',
            'purchase_price'       => 'required|numeric',
            'sale_price'           => 'required|numeric',
            'in_stock'             => 'required|string',
            'tradmark_id'          => 'required|numeric|exists:tradmarks,id',
            'stock'                => 'required|numeric',
            'visible'              => 'required|string|max:191',
            'tax'                  => 'required|numeric',
            'category_id'          => 'required|numeric|exists:categories,id',
            'user_id'              => 'sometimes|nullable|numeric|exists:users,id',
            'owner'                => 'sometimes|nullable|in:for_seller,for_site_owner',
            'image'                => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'gallery.*'            => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'description_en'       => 'sometimes|nullable|string',
            'short_description_en' => 'sometimes|nullable|string',
            'tags_en'              => 'sometimes|nullable|max:191',
            'length'               => 'sometimes|nullable|max:191',
            'width'                => 'sometimes|nullable|max:191',
            'height'               => 'sometimes|nullable|max:191',
            'weight'               => 'sometimes|nullable|max:191',
            'name_en'              => 'required|string|max:191',
            'size_en'              => 'sometimes|nullable|string',
            'color_en'             => 'sometimes|nullable|string',
            'shippings'            => 'required|exists:shipping_methods,id',
            'attributes.*'         => 'sometimes|nullable|exists:attributes,id',
            'key.*'                => 'sometimes|nullable',
            'value.*'              => 'sometimes|nullable',
            'has_accessories'      => 'required|string|max:191',
            'meta_tag_en'          => 'sometimes|nullable|string',
            'meta_description_en'  => 'sometimes|nullable|string',
            'meta_keyword_en'      => 'sometimes|nullable|string',
        ]);
        return view('Admin.' . $this->path . '.create', ['title' => 'Create ' . $this->path,
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
        if ($request['owner'] == 'for_site_owner') {
            $request['user_id'] = 1;
        }
        $data_spec = [];
        if($request['key']) {
            foreach($request['key'] as $index => $key) {
                array_push($data_spec,[$key => $request['value'][$index]]);
            }
        }

        $seller = '';
        if($request['owner'] == 'for_site_owner') {
            $request['user_id'] = 1;
        } else {
            $seller = SellerInfo::findOrfail($request['seller_id'])->seller;
        }
        $product = $this->model::create([
            'sku'               => $request['sku'],
            'section'           => $request['section'],
            'product_type'      => $request['product_type'],
            'purchase_price'    => $request['purchase_price'],
            'sale_price'        => $request['sale_price'],
            'in_stock'          => $request['in_stock'],
            'tradmark_id'       => $request['tradmark_id'],
            'owner'             => $request['owner'],
            'user_id'           => $request['user_id']?$request['user_id']:$seller->id,
            'seller_id'         => $request['seller_id'],
            'stock'             => $request['stock'],
            'visible'           => $request['visible'],
            'tax'               => $request['tax'],
            'category_id'       => $request['category_id'],
            'approved'          => 1,
            'image'             => $img,
            'description'       => $request['description_en'],
            'short_description' => $request['short_description_en'],
            'slug'              => \Str::slug($request['slug']),
            'data'              => ($data_spec)? $data_spec: NULL,
            'length'            => (empty($request['length'])) ? null : $request['length'],
            'width'             => (empty($request['width'])) ? null : $request['width'],
            'height'            => (empty($request['height'])) ? null : $request['height'],
            'weight'            => (empty($request['weight'])) ? null : $request['weight'],
            'name'              => $request['name_en'],
            'size'              => (empty($request['size_en'])) ? null : $request['size_en'],
            'color'             => (empty($request['color_en'])) ? null : $request['color_en'],
            'has_accessories'   => $request['has_accessories'],
            'meta_tag'          => (empty($request['meta_tag_en'])) ? null : $request['meta_tag_en'],
            'meta_description'  => (empty($request['meta_description_en'])) ? null : $request['meta_description_en'],
            'meta_keyword'      => (empty($request['meta_keyword_en'])) ? null : $request['meta_keyword_en'],
        ]);
        if (!empty($request['tags_en'])) {
            $data_en = explode(',', $request['tags_en']);
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                ($localeCode == 'en') ? '' : ${'data_' . $localeCode} = explode(',', $request['tags_' . $localeCode]);
            }
            foreach ($data_en as $index => $att) {
                $product->attachTag($att, 'products');
                $tag = \Spatie\Tags\Tag::findOrCreate($att, 'products');
                foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    if ($localeCode != 'en') {
                        if (!empty(${'data_' . $localeCode}[$index])) {
                            $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                        }
                    }
                }
            }
            $product->tagsWithType('products');
        }
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $product->setTranslation('name', $localeCode, $request['name_' . $localeCode])->save();
            (empty($request['description_' . $localeCode])) ?: $product->setTranslation('description', $localeCode, $request['description_' . $localeCode])->save();
            (empty($request['short_description_' . $localeCode])) ?: $product->setTranslation('short_description', $localeCode, $request['short_description_' . $localeCode])->save();
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
            multiple_uploads($request['gallery'], $this->path, $product, 600, 350);

        }
        Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect(aurl('/products'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows = $this->model::findOrFail($id);
        return view('Admin.' . $this->path . '.show', ['title' => 'Show ' . $this->path, 'rows' => $rows]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $validatorCategoryForm = \JsValidator::make([
            'sku'                  => 'sometimes|required|string|max:191|unique:products,sku,' . $id,
            'slug'                 => 'sometimes|required|string|max:191|unique:products,slug,' . $id,
            'product_type'         => 'required|string',
            'purchase_price'       => 'required|numeric',
            'sale_price'           => 'required|numeric',
            'in_stock'             => 'required|string',
            'tradmark_id'          => 'required|numeric',
            'stock'                => 'required|numeric',
            'visible'              => 'required|string|max:191',
            'tax'                  => 'required|numeric',
            'category_id'          => 'required|numeric',
            'image'                => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:products,image,' . $id,
            'description_en'       => 'sometimes|nullable|string',
            'short_description_en' => 'sometimes|nullable|string',
            'length_en'            => 'sometimes|nullable|max:191',
            'width_en'             => 'sometimes|nullable|max:191',
            'height_en'            => 'sometimes|nullable|max:191',
            'weight_en'            => 'sometimes|nullable|max:191',
            'name_en'              => 'required|string|max:191',
            'size_en'              => 'sometimes|nullable|string',
            'color_en'             => 'sometimes|nullable|string',
            'shippings'            => 'sometimes|nullable',
        ]);
        $rows = $this->model::findOrFail($id);
        $attributes = $rows->attributes;
        $ids = [];
        foreach ($attributes as $val) {
            array_push($ids, $val->id);
        }
        $newAttributes = Attribute::whereNotIn('id', $ids)->select('name', 'id')->get();
        $zones = Shipping_methods::select('name', 'id', 'zone_id', 'company_id')->with('zone:id,name')->with('shippingcompany:id,name')->get();
        $methods = $rows->methods()->with('zone:id,name')->with('shippingcompany:id,name')->get();
        return view('Admin.' . $this->path . '.edit', ['title' => 'Edit ' . $this->path, 'methods' => $methods, 'rows' => $rows, 'data' => $zones, 'attributes' => $newAttributes,
            'values' => $attributes, 'Validator' => $validatorCategoryForm]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function update(productsRequestUpdate $request, $id)
    {
        $shippings = $this->validate(request(), [
            'shippings.*' => 'sometimes|nullable|numeric',

        ], [], [
            'shippings' => trans('admin.shippings'),
        ]);
        $img = '';
        if (!empty($request['image'])) {
            $image = $this->model::find($id)->image;
            \Storage::delete($image);
            $img = upload($request['image'], $this->path);
        } else {
            $img = $this->model::find($id)->image;
        }
        $data_spec = [];
        if($request['key']) {
            foreach($request['key'] as $index => $key) {
                array_push($data_spec,[$key => $request['value'][$index]]);
            }
        }
        $seller = '';
        if($request['owner'] == 'for_site_owner') {
            $request['user_id'] = 1;
        } else {
            $seller = SellerInfo::findOrfail($request['seller_id'])->seller;
        }

        $this->model::where('id', $id)->update([
            'sku'             => $request['sku'],
            'section'         => $request['section'],
            'product_type'    => $request['product_type'],
            'purchase_price'  => $request['purchase_price'],
            'sale_price'      => $request['sale_price'],
            'in_stock'        => $request['in_stock'],
            'tradmark_id'     => $request['tradmark_id'],
            'stock'           => $request['stock'],
            'visible'         => $request['visible'],
            'tax'             => $request['tax'],
            'owner'           => $request['owner'],
            'user_id'         => $request['user_id']?$request['user_id']:$seller->id,
            'seller_id'       => $request['seller_id'],
            'category_id'     => $request['category_id'],
            'image'           => $img,
            'slug'            => \Str::slug($request['slug']),
            'data'            => $data_spec,
            'length'          => (empty($request['length'])) ? null : $request['length'],
            'width'           => (empty($request['width'])) ? null : $request['width'],
            'height'          => (empty($request['height'])) ? null : $request['height'],
            'weight'          => (empty($request['weight'])) ? null : $request['weight'],
            'has_accessories' => $request['has_accessories'],
        ]);
        $product = Product::find($id);

        if (!empty($request['tags_en'])) {
            LaravelLocalization::setLocale('en');
            $data_en = explode(',', $request['tags_en']);
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                ($localeCode === 'en') ? '' : ${'data_' . $localeCode} = explode(',', $request['tags_' . $localeCode]);
            }
            $product->syncTagsWithType($data_en, 'products');
            foreach ($data_en as $index => $tag) {
                $tag = \Spatie\Tags\Tag::findOrCreate($tag, 'products');
                //dd($tag);
                foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    if ($localeCode != 'en') {
                        if (!empty(${'data_' . $localeCode}[$index])) {
                            //dd(${'data_' . $localeCode}[$index]);
                            $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                        }
                    }
                }
            }

            $product->tagsWithType('products');
        }

        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $product->setTranslation('name', $localeCode, $request['name_' . $localeCode])->save();
            (empty($request['description_' . $localeCode])) ?: $product->setTranslation('description', $localeCode, $request['description_' . $localeCode])->save();
            (empty($request['short_description_' . $localeCode])) ?: $product->setTranslation('short_description', $localeCode, $request['short_description_' . $localeCode])->save();
            (empty($request['size_' . $localeCode])) ?: $product->setTranslation('size', $localeCode, $request['size_' . $localeCode])->save();
            (empty($request['color_' . $localeCode])) ?: $product->setTranslation('color', $localeCode, $request['color_' . $localeCode])->save();
            (empty($request['meta_tag_' . $localeCode])) ?: $product->setTranslation('meta_tag', $localeCode, $request['meta_tag_' . $localeCode])->save();
            (empty($request['meta_description_' . $localeCode])) ?: $product->setTranslation('meta_description', $localeCode, $request['meta_description_' . $localeCode])->save();
            (empty($request['meta_keyword_' . $localeCode])) ?: $product->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_' . $localeCode])->save();
        };
        if ($request['product_type'] === 'variable') {
            $product->attributes()->sync($request['attributes']);
        } else {
            $product->attributes()->detach($request['attributes']);
        }
        $product->methods()->sync($shippings['shippings']);

        if (!empty($request['gallery'])) {
            multiple_uploads($request['gallery'], $this->path, $product, 600, 350);
        }

        Alert::success(trans('admin.updated'), trans('admin.updated_record'));
        return redirect(aurl('/products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $row = $this->model::findOrFail($id);
        \Storage::delete($row->image);
        $row->carts()->chunk(50, function ($cart) {
            dispatch(new DeleteCartItems($cart));
        });
        $row->delete();
        return redirect()->route($this->route . '.index');
    }




    public function destory_all(Request $request)
    {
        if (request()->has('item') && $request->item != '') {
            if (is_array($request->item)) {

                Product::whereIn('id', $request->item)->chunk(50, function ($products) {
                    dispatch(new DestroyAllProducts($products));
                });

            } else {
                $row = $this->model::findOrFail($request->item);
                \Storage::delete($row->image);
                $row->carts()->chunk(50, function ($cart) {
                    dispatch(new DeleteCartItems($cart));

                });
                $row->delete();
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->route . '.index');
    }

    /**************************************   Variation index Start   ************************************** */
    public function variations_index($id)
    {
        $product        = Product::findOrFail($id);
        $variablesArray = Variable::where('product_id', $product->id)->get();
        $inventoryArray = inventory::where('product_id', $product->id)->get();
        $valuesArray    = [];
        $value_ids      = [];
        foreach ($variablesArray as $variable) {
            $valueArray = Value::where('variable_id', $variable->id)->get();
            array_push($valuesArray, $valueArray);
            foreach ($valueArray as $value) {
                $value_id = Value_id::where('value_id', $value->id)->get();
                foreach ($value_id as $val) {
                    array_push($value_ids, $val);
                }
            }

        }
        return view('Admin.' . $this->path . '.variations', ['title' => 'Variations Page',
            'product' => $product, 'variablesArray' => $variablesArray, 'inventoryArray' => $inventoryArray, 'valuesArray' => $valuesArray,
            'value_ids' => $value_ids]);
    }
    /**************************************   Variation index End   ************************************** */

    /**************************************   Variation Store Start   ************************************** */

    public function variations_store(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'variations.*'  => 'required|string',
            'price.*'       => 'required|numeric',
            'in_stock.*'    => 'sometimes|nullable|string',
            'sku.*'         => 'sometimes|nullable|string',
            'description.*' => 'sometimes|nullable|string',
            'image.*'       => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'stock.*'       => 'required|string',
            'visible.*'     => 'required|string',
            'length.*'      => 'sometimes|nullable|string',
            'width.*'       => 'sometimes|nullable|string',
            'height.*'      => 'sometimes|nullable|string',
            'weight.*'      => 'sometimes|nullable|string',
        ], [], [
            'variations'  => trans('admin.variations'),
            'price'       => trans('admin.price'),
            'in_stock'    => trans('admin.in_stock'),
            'sku'         => trans('admin.sku'),
            'description' => trans('admin.description'),
            'image'       => trans('admin.image'),
            'stock'       => trans('admin.stock'),
            'visible'     => trans('admin.visible'),
            'length'      => trans('admin.length'),
            'width'       => trans('admin.width'),
            'height'      => trans('admin.height'),
            'weight'      => trans('admin.weight'),
        ]);

        $variations = array_chunk($data['variations'], count($data['variations']) / count($data['price']));
        $inventories = inventory::where('product_id', $id)->get();
        foreach ($inventories as $inventory) {
            \Storage::delete($inventory->image);
            $inventory->delete();
        }
        foreach ($data['price'] as $index => $price) {
            // dd(implode(',',$variations[1]));
            // $variation = implode(',',$variations[$index]);

            if (!empty($data['image'][$index])) {
                $filenamewithextension = $data['image'][$index]->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $data['image'][$index]->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

                \Storage::put('public/variableProduct' . '/' . $filenametostore, fopen($data['image'][$index], 'r+'));
                // \Storage::put('public/variableProduct'.'/thumbnail/'. $filenametostore, fopen($data['image'][$index], 'r+'));

                //Resize image here
                // $thumbnailpath = public_path('storage/'.'variableProduct'.'/thumbnail/'.$filenametostore);
                // $image = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
                //  $constraint->aspectRatio();
                // });
                // $image->save($thumbnailpath);
                $data['image'][$index] = 'variableProduct' . '/' . $filenametostore;
            }
            $inventory = inventory::create([
                'product_id'  => $id,
                'price'       => $price,
                'in_stock'    => (empty($data['in_stock'][$index])) ? null : $data['in_stock'][$index],
                'sku'         => (empty($data['sku'][$index])) ? null : $data['sku'][$index],
                'description' => (empty($data['description'][$index])) ? null : $data['description'][$index],
                'image'       => (empty($data['image'][$index])) ? null : $data['image'][$index],
                'stock'       => (empty($data['stock'][$index])) ? null : $data['stock'][$index],
                'visible'     => (empty($data['visible'][$index])) ? null : $data['visible'][$index],
                'length'      => (empty($data['length'][$index])) ? null : $data['length'][$index],
                'width'       => (empty($data['width'][$index])) ? null : $data['width'][$index],
                'height'      => (empty($data['height'][$index])) ? null : $data['height'][$index],
                'weight'      => (empty($data['weight'][$index])) ? null : $data['weight'][$index],
            ]);
            foreach ($variations[$index] as $variation) {
                if ($variation != 'NULL') {
                    Value_id::create([
                        'value_id' => $variation,
                        'inv_id' => $inventory->id,
                    ]);
                }
            }
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('/products'));

    }

    /**************************************   Variation Store End   ************************************** */
    public function add_accessories($id)
    {
        $title = trans('admin.add_accessories');
        $product = Product::find($id);
        return view('Admin.products.add_accessories', ['product' => $product, 'title' => $title]);

    }

    public function approved($id)
    {
        //$title = trans('admin.add_accessories');
        $product = Product::findOrFail($id);
        if ($product) {
            $product->update(['approved' => 1]);
        }
        return redirect()->route('products.index');

    }

    public function reviews($id)
    {
        $product = Product::findOrFail($id);
        if ($product) {
            return view('Admin.products.reviews', ['product' => $product,
                'title' => $product->name . ' ' . trans('admin.reviews')]);
        }
        return redirect()->route('products.index');

    }

    public function reviews_approve($id)
    {
        $product = DB::table('reviews')->where('id', $id)->where('reviewrateable_type', 'App\Product');
        if ($product) {
            //dd($product);
            $product->update(['approved' => 1]);
        }
        Alert::success(trans('admin.updated'), trans('admin.updated_record'));

        return redirect()->back();

    }
}
