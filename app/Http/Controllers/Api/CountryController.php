<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\TradmarkResource;
use App\Country;
use App\Category;
use App\Tradmark;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\LangApi;
class CountryController extends Controller
{
    use ApiResponse, LangApi;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        $this->checkLang($locale);

        return $this->sendResult('paginate 10 Countries',
        CountryResource::collection(Country::paginate(10)));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale,$id) {
        $this->checkLang($locale);

        $Country = Country::where('id',$id)->first();
        if($Country) {
            return $this->sendResult('show Country',new CountryResource($Country));
        }
        return $this->sendResult('Country not found',null, 'Country not found',false);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_index()
    {
        return $this->sendResult('paginate 10 Category',
        CategoryResource::collection(Category::paginate(10)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function category_show($slug)
    {
        $Category = Category::where('slug',$slug)->first();
        if($Category) {
            return $this->sendResult('show Category',new CategoryResource($Category));
        }
        return $this->sendResult('Category not found',null, 'Category not found',false);
    }


    public function brands_index()
    {
        return $this->sendResult('paginate 10 brands',
        TradmarkResource::collection(Tradmark::paginate(10)));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function brands_show($slug)
    {
        $brands = Tradmark::where('slug',$slug)->first();
        if($brands) {
            return $this->sendResult('show brands',new TradmarkResource($brands));
        }
        return $this->sendResult('brands not found',null, 'brands not found',false);
    }
}
