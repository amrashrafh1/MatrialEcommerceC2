<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\OurworksResource;
use App\Ourwork;
use App\Http\Controllers\Api\ApiResponse;

class OurworkController extends Controller
{
    use ApiResponse;

    public function index() {

        return $this->sendResult('paginate 10 ourworks',
        OurworksResource::collection(Ourwork::paginate(10)));
    }


    public function show($id) {

        $ourwork = Ourwork::where('id',$id)->first();
        if($ourwork) {
            return $this->sendResult('show ourworks',new OurworksResource($ourwork));
        }
        return $this->sendResult('ourwork not found',null, 'ourwork not found',false);
    }
}
