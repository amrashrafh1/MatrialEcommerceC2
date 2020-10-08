<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\AdzResource;
use App\Adz;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\LangApi;

class AdzController extends Controller
{
    use ApiResponse, LangApi;

    public function index() {

        return $this->sendResult('paginate 10 advertizments',
        AdzResource::collection(Adz::paginate(10)));
    }


    public function show($id) {

        $adz = Adz::where('id',$id)->first();
        if($adz) {
            return $this->sendResult('show advertizment',new AdzResource($adz));
        }
        return $this->sendResult('Adz not found',null, 'Adz not found',false);
    }

}
