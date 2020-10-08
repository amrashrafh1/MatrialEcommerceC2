<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ApiResponse;
use App\ContactUs;
class ContactUsController extends Controller
{
    use ApiResponse;


    public function store(Request $request) {
        $data = $this->validate(request(),[
            'name'    => 'required|string|max:199',
            'email'   => 'required|email',
            'mobile'  => 'required|string|max:199',
            'subject' => 'required|string|max:199',
            'message' => 'required|string|max:1000',
        ],[],[
            'name'    => trans('user.name'),
            'email'   => trans('user.email'),
            'mobile'  => trans('user.mobile'),
            'subject' => trans('user.subject'),
            'message' => trans('user.message'),
        ]);

        ContactUs::create($data);

        return $this->sendResult('success', null, null, true);

    }
}
