<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\SellerInfo;
use App\Mail\ApplicationAccepted;
use App\Mail\ApplicationRejected;
use Mail;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware(['permission:read-sellers-app'])->only('index');
        $this->middleware(['permission:create-sellers-app'])->only('accept');
    }

     public function index($id)
    {
        $application = SellerInfo::findOrFail($id);
        return view('Admin.application.index', ['title' => trans('admin.new_seller_application'), 'application' => $application]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $application = SellerInfo::findOrFail($id);
        $user        = User::findOrFail($application->seller_id);
        $application->update(['approved' => 1]);
        $user->syncRoles(['seller']);
        Mail::to($user->email)->send(new ApplicationAccepted());
        \Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route('stores.index');
    }

    public function reject(Request $request, $id)
    {
        $message = $this->validate(request(), [
            'message' => 'required|string',
        ], [], [
            'message' => trans('admin.message'),
        ]);
       // dd($message['message']);
        $application = SellerInfo::findOrFail($id);
        \Storage::delete($application->image);
        $user        = User::findOrFail($application->seller_id);
        $application->delete();
        Mail::to($user->email)->send(new ApplicationRejected($message['message']));
        \Alert::success(trans('admin.delete'), trans('admin.deleted'));
        return redirect()->route('stores.index');
    }
}
