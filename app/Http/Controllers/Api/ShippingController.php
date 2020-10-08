<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingMethodResource;
use App\Http\Resources\AttributeFamily2Resource;
use App\Shipping_methods;
use App\Attribute_Family;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\LangApi;

class ShippingController extends Controller
{
    use ApiResponse, LangApi;

    public function index($locale) {

        $this->checkLang($locale);

        return $this->sendResult('paginate 10 Shipping methods',
            ShippingMethodResource::collection(Shipping_methods::paginate(10)));
    }


    public function show($locale,$id) {

        $this->checkLang($locale);

        $Shipping_methods = Shipping_methods::where('id',$id)->first();
        if($Shipping_methods) {
            return $this->sendResult('show Shipping methods',new ShippingMethodResource($Shipping_methods));
        }
        return $this->sendResult('Shipping methods not found',null, 'Shipping methods not found',false);
    }


    public function index_attributes($locale) {

        $this->checkLang($locale);


        return $this->sendResult('paginate 10 attributes',
            AttributeFamily2Resource::collection(Attribute_Family::paginate(10)));
    }


    public function show_attributes($locale,$id) {

        $this->checkLang($locale);

        $attribute = Attribute_Family::where('id',$id)->first();
        if($attribute) {
            return $this->sendResult('show attribute',new AttributeFamily2Resource($attribute));
        }
        return $this->sendResult('attribute not found',null, 'attribute not found',false);
    }
}
