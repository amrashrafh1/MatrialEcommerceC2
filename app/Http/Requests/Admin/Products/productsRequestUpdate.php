<?php

namespace App\Http\Requests\Admin\Products;

use App\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class productsRequestUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku'                  => 'sometimes|required|string|max:191|unique:products,sku,'.$this->product,
            'slug'                 => 'sometimes|required|string|max:191|unique:products,slug,'.$this->product,
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
            'image'                => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:products,image,'.$this->product,
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
            'shippings'            => 'required',
            'attributes.*'         => 'sometimes|nullable|numeric|max:191',
            'has_accessories'      => 'required|string|max:191',
            'meta_tag_en'          => 'sometimes|nullable|string',
            'meta_description_en'  => 'sometimes|nullable|string',
            'meta_keyword_en'      => 'sometimes|nullable|string',
        ];
    }
}
