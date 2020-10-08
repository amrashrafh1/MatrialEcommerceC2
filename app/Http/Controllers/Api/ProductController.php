<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\LangApi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Products\productsRequestStore;
use App\Http\Resources\ProductResource;
use App\Product;
use LaravelLocalization;
use App\Jobs\DeleteCartItems;


class ProductController extends Controller
{
    use ApiResponse, LangApi;

    public function __construct()
    {
        $this->middleware(['auth:api'
        ,'role:seller'
        ]);
    }


    public function index($locale)
    {
       // return $locale;
        // method for check the lang
        $this->checkLang($locale);

        return $this->sendResult('paginate 10 products',
            ProductResource::collection(
                Product::with('variations.attributes')
                ->with('attributes')->with('category.categories')
                ->paginate(10)
            ));
    }

    public function show($locale,$slug)
    {
        // method for check the lang
        $this->checkLang($locale);

        $product = Product::where('slug', $slug)->first();
        if ($product) {
            return $this->sendResult('show product', new ProductResource($product));
        }
        return $this->sendResult('Product not found', null, 'Product not found', false);
    }

    public function store(productsRequestStore $request)
    {

        $shippings = $this->validate(request(), [
            'shippings.*' => 'required|numeric',
        ], [], [
            'shippings' => trans('admin.shippings'),
        ]);
        $img = '';
        if (!empty($request['image'])) {
            $img = upload($request['image'], '/products');
        }
        try {

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
                multiple_uploads($request['gallery'], '/products', $product, 600, 350);

            }
            return $this->sendResult('show product', new ProductResource($product));
            //}
        } catch (\Exeption $e) {
            return $this->sendResult($e->getMessage(), null, $e->getMessage(), false);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $rows = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
            if ($rows) {
                $data = $this->validate(request(), [
                    'sku'                  => 'required|string|max:191|unique:products,sku,' . $rows->id,
                    'slug'                 => 'required|string|max:191|unique:products,slug,' . $rows->id,
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
                    'image'                => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:products,image,' . $rows->id,
                    'gallery.*'            => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
                    'description_en'       => 'sometimes|nullable|string',
                    'short_description_en' => 'sometimes|nullable|string|max:255',
                    'tags_en'              => 'sometimes|nullable|max:191',
                    'user_id'              => 'sometimes|nullable|numeric',
                    'owner'                => 'sometimes|nullable|in:for_seller,for_site_owner',
                    'length'               => 'sometimes|nullable|max:191',
                    'width'                => 'sometimes|nullable|max:191',
                    'height'               => 'sometimes|nullable|max:191',
                    'weight'               => 'sometimes|nullable|max:191',
                    'name_en'              => 'required|string|max:191',
                    'size_en'              => 'sometimes|nullable|string',
                    'color_en'             => 'sometimes|nullable|string',
                    'shippings'            => 'required|exists:shipping_methods,id',
                    'attributes.*'         => 'sometimes|nullable|numeric|exists:attributes,id',
                    'has_accessories'      => 'required|string|max:191',
                    'meta_tag_en'          => 'sometimes|nullable|string',
                    'meta_description_en'  => 'sometimes|nullable|string',
                    'meta_keyword_en'      => 'sometimes|nullable|string',
                ]);
                $shippings = $this->validate(request(), [
                    'shippings.*' => 'sometimes|nullable|numeric|exists:shipping_methods,id',

                ], [], [
                    'shippings' => trans('admin.shippings'),
                ]);
                $img = '';
                if (!empty($request['image'])) {
                    $image = $rows->image;
                    \Storage::delete($image);
                    $img = upload($request['image'], '/products');
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
                    multiple_uploads($request['gallery'], '/products', 'App\Product', $rows->id, 600, 350);
                }
                \Alert::success(trans('admin.updated'), trans('admin.updated_record'));
            }
            return $this->sendResult('show product', new ProductResource($rows));

            //}
        } catch (\Exeption $e) {
            return $this->sendResult($e->getMessage(), null, $e->getMessage(), false);

        }
        return redirect()->route('seller_frontend_products');
    }



    public function destroy($slug)
    {
        try {
            $row = Product::where('slug', $slug)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first();
            if($row) {
                \Storage::delete($row->image);
                $row->carts()->chunk(50, function ($cart) {
                    dispatch(new DeleteCartItems($cart));
                });
                $row->delete();
            }
            return $this->sendResult('success', null, null, true);
        }
        catch(\Exeption $e) {
            return $this->sendResult($e->getMessage(), null, $e->getMessage(), false);
        }
    }
    public function destory_all(Request $request)
    {
        try {
        if(request()->has('item') && $request->item != '') {
            if(is_array($request->item)) {
                foreach($request->item as $d) {
                    $row = Product::findOrFail($d);
                    \Storage::delete($row->image);
                    $row->carts()->chunk(50, function ($cart) {
                        dispatch(new DeleteCartItems($cart));
                    });
                    @$row->delete();
                }
            } else {
                $row = Product::findOrFail($request->item);
                \Storage::delete($row->image);
                $row->carts()->chunk(50, function ($cart) {
                    dispatch(new DeleteCartItems($cart));
                });
                @$row->delete();
            }
        }
        return $this->sendResult(count($request->item) . ' item Deleted successfuly', null, null, true);

        }
        catch(\Exeption $e) {
            return $this->sendResult($e->getMessage(), null, $e->getMessage(), false);
        }
    }
}
