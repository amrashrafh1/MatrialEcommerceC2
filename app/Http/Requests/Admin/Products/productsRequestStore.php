<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class productsRequestStore extends FormRequest
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
            'short_description_en' => 'sometimes|nullable|string|max:255',
            'tags_en'              => 'sometimes|nullable|max:191',
            'length_en'            => 'sometimes|nullable|max:191',
            'width_en'             => 'sometimes|nullable|max:191',
            'height_en'            => 'sometimes|nullable|max:191',
            'weight_en'            => 'sometimes|nullable|max:191',
            'name_en'              => 'required|string|max:191',
            'size_en'              => 'sometimes|nullable|string',
            'color_en'             => 'sometimes|nullable|string',
            'shippings'            => 'required|exists:shipping_methods,id',
            'attributes.*'         => 'sometimes|nullable|numeric|max:191|exists:attributes,id',
            'has_accessories'      => 'required|string|max:191',
            'meta_tag_en'          => 'sometimes|nullable|string',
            'meta_description_en'  => 'sometimes|nullable|string',
            'meta_keyword_en'      => 'sometimes|nullable|string',
        ];
    }
}
