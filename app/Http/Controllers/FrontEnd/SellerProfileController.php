<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SellerInfo;
class SellerProfileController extends Controller
{
    public function show_seller($slug)
    {
        $store = SellerInfo::where('slug', $slug)->with('products')->first();
        if($store) {
            return view('FrontEnd.seller-profile', ['store' => $store]);
        }
        return redirect()->route('home');
    }


    public function index()
    {
        $store = auth()->user()->stores()->where('id', session('store'))->first();
        if($store) {
            return view('FrontEnd.sellers.profile', ['store' => $store]);
        }
        return redirect()->route('home');
    }

    public function update(Request $request, $id) {

        $data = $this->validate(request(), [
            'country_id'  => 'required|numeric|exists:countries,id',
            'name'        => 'required|string|max:191',
            'email'       => 'required|email|unique:seller_infos,email,'. $id,
            'city'        => 'required|string',
            'state'       => 'sometimes|nullable|string',
            'address1'    => 'required|string',
            'address2'    => 'sometimes|nullable|string',
            'address3'    => 'sometimes|nullable|string',
            'phone1'      => 'required|string',
            'phone2'      => 'sometimes|nullable|string',
            'phone3'      => 'sometimes|nullable|string',
            'image'       => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'type'        => 'required|in:0,1',                                                 //0 = individual && 1 = business
            'business'    => 'required|string',
            'description' => 'required|min:3|max:1000',
        ], [], [
            'country_id'  => trans('user.country'),
            'name'        => trans('user.name'),
            'email'       => trans('user.email'),
            'city'        => trans('user.city'),
            'state'       => trans('user.state'),
            'address1'    => trans('user.address1'),
            'address2'    => trans('user.address2'),
            'address3'    => trans('user.address3'),
            'phone1'      => trans('user.phone1'),
            'phone2'      => trans('user.phone2'),
            'phone3'      => trans('user.phone3'),
            'image'       => trans('user.image'),
            'type'        => trans('user.type'),
            'business'    => trans('user.business'),
            'description' => trans('user.description'),
        ]);

        $store = SellerInfo::where('id', $id)->first();

        if($store) {
            $img = '';
            if (!empty($data['image'])) {
                $img = upload($data['image'], 'stores', 1446, 409);
            }
            $data['slug']      = \Str::slug($data['name']);
            $data['image']     = ($img)?$img:$store->image;
            $data['seller_id'] = auth()->user()->id;
            $store->update($data);
            \Alert::success(trans('admin.updated'), trans('admin.updated_record'));

            return redirect()->route('store_profile');
        }
        return redirect()->back();

    }
}
