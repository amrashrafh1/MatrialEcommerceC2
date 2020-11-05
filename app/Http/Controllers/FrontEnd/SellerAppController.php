<?php

namespace App\Http\Controllers\FrontEnd;

use App\Events\NewSeller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SellerInfo;

class SellerAppController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $seller_app = \JsValidator::make([
            'country_id'  => 'required|numeric|exists:countries,id',
            'name'        => 'required|string|max:191',
            'email'       => 'required|email|unique:seller_infos,email',
            'city'        => 'required|string',
            'state'       => 'sometimes|nullable|string',
            'address1'    => 'required|string',
            'address2'    => 'sometimes|nullable|string',
            'address3'    => 'sometimes|nullable|string',
            'phone1'      => 'required|string',
            'phone2'      => 'sometimes|nullable|string',
            'phone3'      => 'sometimes|nullable|string',
            'image'       => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'type'        => 'required|in:0,1', //0 = individual && 1 = business
            'business'    => 'required|string',
            'description' => 'required|min:3|max:1000',
        ]);
        return view('FrontEnd.sellers.seller-app', ['SellerApp' => $seller_app]);

    }

    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'country_id'  => 'required|numeric|exists:countries,id',
            'name'        => 'required|string|max:191',
            'email'       => 'required|email|unique:users,email',
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
        $img = '';
        if (!empty($data['image'])) {
            $img = upload($data['image'], 'users', 1446, 409);
        }
        $data['slug']      = \Str::slug($data['name']);
        $data['image']     = $img;
        $data['seller_id'] = auth()->user()->id;
        SellerInfo::create($data);

        event(new NewSeller(trans('admin.new_seller_application')));

        \Alert::success(trans('admin.added'), trans('user.Your_request_will_be_reviewed_by_the_admin_and_will_be_replied_within_24_hours'));

        return redirect()->route('seller_app');
    }
}
