<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AttributeResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\VariationResource;
use App\Http\Resources\FileResource;
use App\Http\Resources\ShippingMethodResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\AccessoriesResource;
use App\Http\Resources\DiscountResource;
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'slug'              => $this->slug,
            'sku'               => $this->sku,
            'product_type'      => $this->product_type,
            'sale_price'        => $this->sale_price,
            'stock'             => $this->stock,
            'size'              => $this->size,
            'color'             => $this->color,
            'description'       => $this->description,
            'short_description' => $this->short_description,
            'image'             => $this->image,
            'tradmark'          => new TradmarkResource($this->tradmark),
            'user'              => new UserResource($this->seller),
            'owner'             => $this->owner,
            'category'          => new CategoryResource($this->category),
            'length'            => $this->length,
            'width'             => $this->width,
            'height'            => $this->height,
            'weight'            => $this->weight,
            'in_stock'          => $this->in_stock,
            'data'              => $this->data,
            'visible'           => $this->visible,
            'tax'               => $this->tax,
            'shipping_methods'  => ShippingMethodResource::collection($this->methods),
            'variations'        => VariationResource::collection($this->variations),
            'has_accessories'   => $this->has_accessories,
            'accessories'       => AccessoriesResource::collection($this->accessories),
            'attributes'        => AttributeResource::collection($this->attributes),
            'files'             => FileResource::collection($this->gallery),
            'discount'          => new DiscountResource($this->discount),

        ];
    }
}
