<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\DataTables\SellerProductsDatatable;
use App\Product;
use App\Shipping_methods;
use App\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ProductDataTable;
use App\Http\Requests\Admin\Products\productsRequestStore;
use App\Http\Requests\Admin\Products\productsRequestUpdate;
//use Illuminate\Support\Facades\Cache;
use App\inventory;
use App\Product_Attribute;
use Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Arr;
use LaravelLocalization;
class ProductController extends Controller
{
    protected $model = '';
    protected $path  = 'products';
    protected $route = 'products';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Product::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $datatable)
    {
        return $datatable->render('Admin.'.$this->path.'.index', ['title' => $this->path . ' Table']);
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
            'shippings'      => 'required'
        ]);
        return view('Admin.'.$this->path.'.create',['title' => 'Create ' . $this->path,
        'Validator' =>$validatorCategoryForm
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
        ],[],[
            'shippings' => trans('admin.shippings'),
        ]);
       // dd($shippings);
        $img = '';
        if(!empty($request['image'])) {
            $img =  upload($request['image'], $this->path);
        }
        if($request['owner'] == 'for_site_owner') {
            $request['user_id'] = 1;
        }

        $product = $this->model::create([
            'sku'              => $request['sku'],
            'section'          => $request['section'],
            'product_type'     => $request['product_type'],
            'purchase_price'   => $request['purchase_price'],
            'sale_price'       => $request['sale_price'],
            'in_stock'         => $request['in_stock'],
            'tradmark_id'      => $request['tradmark_id'],
            'owner'            => $request['owner'],
            'user_id'          => $request['user_id'],
            'stock'            => $request['stock'],
            'visible'          => $request['visible'],
            'tax'              => $request['tax'],
            'category_id'      => $request['category_id'],
            'approved'         => 1,
            'image'            => $img,
            'description'      => $request['description_en'],
            'slug'             => \Str::slug($request['slug']),
            'length'           => (empty($request['length']))?NULL:$request['length'],
            'width'            => (empty($request['width']))?NULL:$request['width'],
            'height'           => (empty($request['height']))?NULL:$request['height'],
            'weight'           => (empty($request['weight']))?NULL:$request['weight'],
            'name'             => $request['name_en'],
            'size'             => (empty($request['size_en']))?NULL:$request['size_en'],
            'color'            => (empty($request['color_en']))?NULL:$request['color_en'],
            'has_accessories'  => $request['has_accessories'],
            'meta_tag'         => (empty($request['meta_tag_en']))?NULL:$request['meta_tag_en'],
            'meta_description' => (empty($request['meta_description_en']))?NULL:$request['meta_description_en'],
            'meta_keyword'     => (empty($request['meta_keyword_en']))?NULL:$request['meta_keyword_en'],
        ]);
    if(!empty($request['tags_en'])) {
        /* $data_en = explode(',',$request['tags_en']);
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            ($localeCode == 'en')?'':${'data_' . $localeCode} = explode(',',$request['tags_'.$localeCode]);
        }
        foreach($data_en as $index => $att) {
            $product->attachTag($att);
            $tag = \Spatie\Tags\Tag::findOrCreate($att);
            foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                if($localeCode != 'en') {
                    if (!empty(${'data_' . $localeCode}[$index])) {
                        $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                    }
                }
            }
        } */
        $product->attachTags([$request['tags_en']]);
    }
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $product->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
            (empty($request['description_'.$localeCode]))?:$product->setTranslation('description', $localeCode, $request['description_'.$localeCode])->save();
            (empty($request['size_'.$localeCode]))?:$product->setTranslation('size', $localeCode, $request['size_'.$localeCode])->save();
            (empty($request['color_'.$localeCode]))?:$product->setTranslation('color', $localeCode, $request['color_'.$localeCode])->save();
            (empty($request['meta_tag_'.$localeCode]))?:$product->setTranslation('meta_tag', $localeCode, $request['meta_tag_'.$localeCode])->save();
            (empty($request['meta_description_'.$localeCode]))?:$product->setTranslation('meta_description', $localeCode, $request['meta_description_'.$localeCode])->save();
            (empty($request['meta_keyword_'.$localeCode]))?:$product->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_'.$localeCode])->save();

        };
        if($request['product_type'] == 'variable') {
            $product->attributes()->attach($request['attributes']);

        }
        $product->methods()->attach($shippings['shippings']);
        if(!empty($request['gallery'])) {
            multiple_uploads($request['gallery'], $this->path, 'App\Product',$product->id,600,350);
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
        return view('Admin.'.$this->path.'.show', ['title' => 'Show ' .  $this->path, 'rows'=>$rows]);
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
            'sku'            => 'sometimes|required|string|max:191|unique:products,sku,'.$id,
            'slug'           => 'sometimes|required|string|max:191|unique:products,slug,'.$id,
            'product_type'   => 'required|string',
            'purchase_price' => 'required|numeric',
            'sale_price'     => 'required|numeric',
            'in_stock'       => 'required|string',
            'tradmark_id'    => 'required|numeric',
            'stock'          => 'required|numeric',
            'visible'        => 'required|string|max:191',
            'tax'            => 'required|numeric',
            'category_id'    => 'required|numeric',
            'image'          => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:products,image,'.$id,
            'description_en' => 'sometimes|nullable|string',
            'length_en'      => 'sometimes|nullable|max:191',
            'width_en'       => 'sometimes|nullable|max:191',
            'height_en'      => 'sometimes|nullable|max:191',
            'weight_en'      => 'sometimes|nullable|max:191',
            'name_en'        => 'required|string|max:191',
            'size_en'        => 'sometimes|nullable|string',
            'color_en'       => 'sometimes|nullable|string',
            'shippings'      => 'sometimes|nullable'
        ]);
        $rows = $this->model::findOrFail($id);
        $attributes = $rows->attributes;
        $ids = [];
        foreach($attributes as $val) {
            array_push($ids, $val->id);
        }
        $newAttributes = Attribute::whereNotIn('id',$ids)->select('name','id')->get();
        $zones = Shipping_methods::select('name', 'id','zone_id','company_id')->with('zone:id,name')->with('shippingcompany:id,name')->get();
        $methods = $rows->methods()->with('zone:id,name')->with('shippingcompany:id,name')->get();
        return view('Admin.'.$this->path.'.edit', ['title' => 'Edit ' . $this->path,'methods'=>$methods, 'rows'=>$rows, 'data'=>$zones,'attributes' => $newAttributes,
        'values' => $attributes,'Validator' =>$validatorCategoryForm]);
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

        ],[],[
            'shippings' => trans('admin.shippings'),
        ]);
        $img = '';
        if(!empty($request['image'])) {
            $image = $this->model::find($id)->image;
            \Storage::delete($image);
            $img =  upload($request['image'], $this->path);
        }else {
            $img = $this->model::find($id)->image;
        }
        $this->model::where('id', $id)->update([
            'sku'              => $request['sku'],
            'section'          => $request['section'],
            'product_type'     => $request['product_type'],
            'purchase_price'   => $request['purchase_price'],
            'sale_price'       => $request['sale_price'],
            'in_stock'         => $request['in_stock'],
            'tradmark_id'      => $request['tradmark_id'],
            'stock'            => $request['stock'],
            'visible'          => $request['visible'],
            'tax'              => $request['tax'],
            'category_id'      => $request['category_id'],
            'image'            => $img,
            'description'      => $request['description_en'],
            'slug'             => \Str::slug($request['slug']),
            'length'           => (empty($request['length']))?NULL:$request['length'],
            'width'            => (empty($request['width']))?NULL:$request['width'],
            'height'           => (empty($request['height']))?NULL:$request['height'],
            'weight'           => (empty($request['weight']))?NULL:$request['weight'],
            'name'             => $request['name_en'],
            'size'             => (empty($request['size_en']))?NULL:$request['size_en'],
            'color'            => (empty($request['color_en']))?NULL:$request['color_en'],
            'has_accessories'  => $request['has_accessories'],
            'meta_tag'         => (empty($request['meta_tag_en']))?NULL:$request['meta_tag_en'],
            'meta_description' => (empty($request['meta_description_en']))?NULL:$request['meta_description_en'],
            'meta_keyword'     => (empty($request['meta_keyword_en']))?NULL:$request['meta_keyword_en'],
        ]);
        $product = Product::find($id);

        if(!empty($request['tags_en'])) {
            LaravelLocalization::setLocale('en');
            $data_en = explode(',',$request['tags_en']);
            foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                ($localeCode === 'en')?'':${'data_' . $localeCode} = explode(',',$request['tags_'.$localeCode]);
            }
            $product->syncTags($data_en);
            foreach($data_en as $index => $tag) {
                $tag = \Spatie\Tags\Tag::findOrCreate($tag);
                //dd($tag);
                foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    if($localeCode != 'en') {
                        if (!empty(${'data_' . $localeCode}[$index])) {
                            //dd(${'data_' . $localeCode}[$index]);
                            $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                        }
                    }
                }
            }

        }

        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $product->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
            (empty($request['description_'.$localeCode]))?:$product->setTranslation('description', $localeCode, $request['description_'.$localeCode])->save();
            (empty($request['size_'.$localeCode]))?:$product->setTranslation('size', $localeCode, $request['size_'.$localeCode])->save();
            (empty($request['color_'.$localeCode]))?:$product->setTranslation('color', $localeCode, $request['color_'.$localeCode])->save();
            (empty($request['meta_tag_'.$localeCode]))?:$product->setTranslation('meta_tag', $localeCode, $request['meta_tag_'.$localeCode])->save();
            (empty($request['meta_description_'.$localeCode]))?:$product->setTranslation('meta_description', $localeCode, $request['meta_description_'.$localeCode])->save();
            (empty($request['meta_keyword_'.$localeCode]))?:$product->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_'.$localeCode])->save();
        };
        if($request['product_type'] === 'variable') {
                $product->attributes()->sync($request['attributes']);
        } else {
                $product->attributes()->detach($request['attributes']);
        }
        $product->methods()->sync($shippings['shippings']);

        if(!empty($request['gallery'])) {
            multiple_uploads($request['gallery'], $this->path, 'App\Product',$product->id,600,350);
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
        \DB::table('cart_items')->where('buyable_id', $row->id)->delete();
        $row->delete();
        return redirect()->route($this->route.'.index');
    }
    public function destory_all(Request $request)
    {
        if(request()->has('item') && $request->item != '') {
            if(is_array($request->item)) {
                foreach($request->item as $d) {
                    $row = $this->model::findOrFail($d);
                    \Storage::delete($row->image);
                    \DB::table('cart_items')->where('buyable_id', $row->id)->delete();
                    $row->delete();
                }
            } else {
                $row = $this->model::findOrFail($request->item);
                \Storage::delete($row->image);
                \DB::table('cart_items')->where('buyable_id', $row->id)->delete();
                $row->delete();
            }
        }
        return redirect()->route($this->route.'.index');
    }

 /**************************************   Variation index Start   ************************************** */
    public function variations_index($id) {
        $product = Product::findOrFail($id);
        $variablesArray = Variable::where('product_id', $product->id)->get();
        $inventoryArray = inventory::where('product_id', $product->id)->get();
        $valuesArray = [];
        $value_ids = [];
            foreach($variablesArray as $variable) {
                $valueArray = Value::where('variable_id', $variable->id)->get();
                array_push($valuesArray, $valueArray);
                foreach($valueArray as $value) {
                    $value_id = Value_id::where('value_id',$value->id)->get();
                    foreach($value_id as $val) {
                        array_push($value_ids, $val);
                    }
                }

        }
        return view('Admin.'.$this->path.'.variations', ['title' => 'Variations Page',
        'product'=> $product, 'variablesArray'=>$variablesArray, 'inventoryArray' => $inventoryArray, 'valuesArray' => $valuesArray,
        'value_ids' => $value_ids]);
    }
 /**************************************   Variation index End   ************************************** */


  /**************************************   Variation Store Start   ************************************** */


    public function variations_store(Request $request,$id) {
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
            ],[],[
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

    $variations = array_chunk($data['variations'],count($data['variations']) / count($data['price']));
    $inventories = inventory::where('product_id', $id)->get();
    foreach($inventories as $inventory) {
        \Storage::delete($inventory->image);
        $inventory->delete();
    }
    foreach($data['price'] as $index => $price) {
      // dd(implode(',',$variations[1]));
       // $variation = implode(',',$variations[$index]);

        if(!empty($data['image'][$index])) {
            $filenamewithextension = $data['image'][$index]->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['image'][$index]->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/variableProduct'.'/'. $filenametostore, fopen($data['image'][$index], 'r+'));
           // \Storage::put('public/variableProduct'.'/thumbnail/'. $filenametostore, fopen($data['image'][$index], 'r+'));

            //Resize image here
           // $thumbnailpath = public_path('storage/'.'variableProduct'.'/thumbnail/'.$filenametostore);
           // $image = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            //  $constraint->aspectRatio();
           // });
           // $image->save($thumbnailpath);
            $data['image'][$index] = 'variableProduct'.'/'.$filenametostore;
        }
        $inventory = inventory::create([
            'product_id'  => $id,
            'price'       => $price,
            'in_stock'    => (empty($data['in_stock'][$index]))?NULL:$data['in_stock'][$index],
            'sku'         => (empty($data['sku'][$index]))?NULL:$data['sku'][$index],
            'description' => (empty($data['description'][$index]))?NULL:$data['description'][$index],
            'image'       => (empty($data['image'][$index]))?NULL:$data['image'][$index],
            'stock'       => (empty($data['stock'][$index]))?NULL:$data['stock'][$index],
            'visible'     => (empty($data['visible'][$index]))?NULL:$data['visible'][$index],
            'length'      => (empty($data['length'][$index]))?NULL:$data['length'][$index],
            'width'       => (empty($data['width'][$index]))?NULL:$data['width'][$index],
            'height'      => (empty($data['height'][$index]))?NULL:$data['height'][$index],
            'weight'      => (empty($data['weight'][$index]))?NULL:$data['weight'][$index],
        ]);
        foreach($variations[$index] as $variation) {
            if($variation != 'NULL') {
                Value_id::create([
                    'value_id'  => $variation,
                    'inv_id'    => $inventory->id
                    ]);
                }
        }
}
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('/products'));

    }

      /**************************************   Variation Store End   ************************************** */
    public function add_accessories($id) {
        $title = trans('admin.add_accessories');
        $product = Product::find($id);
        return view('Admin.products.add_accessories', ['product' => $product, 'title' => $title]);

    }

    public function approved($id) {
        //$title = trans('admin.add_accessories');
        $product = Product::findOrFail($id);
        if($product) {
            $product->update(['approved'=> 1]);
        }
        return redirect()->route('products.index');

    }

    public function reviews($id) {
        //$title = trans('admin.add_accessories');
        $product = Product::findOrFail($id);
        if($product) {
            return view('Admin.products.reviews', ['product'=> $product,
             'title' => $product->name . ' ' . trans('admin.reviews')]);
        }
        return redirect()->route('products.index');

    }

    public function reviews_approve($id) {
        $product = \DB::table('reviews')->where('id',$id);
        if($product) {
            //dd($product);
            $product->update(['approved' => 1]);
        }
        Alert::success(trans('admin.updated'), trans('admin.updated_record'));

        return redirect()->back();

    }
}
