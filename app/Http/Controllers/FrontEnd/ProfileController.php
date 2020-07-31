<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\User;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FrontEnd.profile.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(ProfileRequest $request)
    {
        if(!empty($request['image'])) {
            $img = upload($request['image'], 'profiles');
            auth()->user()->update(['image'=> $img]);
        }
        auth()->user()->update($request->except(['image']));

        return back()->withStatus(__('Profile successfully updated.'));

    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => \Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }



    public function order($id) {
        $order = auth()->user()->orders()->findOrFail($id);
        if($order) {
            return view('FrontEnd.profile.order', ['order' => $order]);
        }
    }

}
