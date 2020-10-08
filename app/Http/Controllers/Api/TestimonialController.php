<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TestimonialsResource;
use App\Testimonials;
use App\Http\Controllers\Api\ApiResponse;
class TestimonialController extends Controller
{
    use ApiResponse;

    public function index() {

        return $this->sendResult('paginate 10 Testimonials',
        TestimonialsResource::collection(Testimonials::paginate(10)));
    }


    public function show($id) {

        $Testimonial = Testimonials::where('id',$id)->first();
        if($Testimonial) {
            return $this->sendResult('show Testimonials',new TestimonialsResource($Testimonial));
        }
        return $this->sendResult('Testimonial not found',null, 'Testimonial not found',false);
    }
}
