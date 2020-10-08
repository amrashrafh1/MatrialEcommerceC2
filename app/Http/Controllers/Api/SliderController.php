<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SlidersResource;
use App\Slider;
use App\Http\Controllers\Api\ApiResponse;
class SliderController extends Controller
{
    use ApiResponse;

    public function index() {

        return $this->sendResult('paginate 10 Sliders',
        SlidersResource::collection(Slider::paginate(10)));
    }


    public function show($id) {

        $Slider = Slider::where('id',$id)->first();
        if($Slider) {
            return $this->sendResult('show Sliders',new SlidersResource($Slider));
        }
        return $this->sendResult('Slider not found',null, 'Slider not found',false);
    }
}
