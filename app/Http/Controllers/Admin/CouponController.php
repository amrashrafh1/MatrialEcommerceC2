<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CouponDatatable;
use App\Jobs\CouponJob;
use App\Coupon;
use App\User;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CouponDatatable $datatable)
    {
        return $datatable->render('Admin.coupons.index', ['title' => trans('admin.coupon')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'quantity'  => 'sometimes|nullable|numeric',
            'reward'    => 'required|numeric',
            'amount'    => 'required|numeric|max:10000',
            'rules'     => 'sometimes|nullable|in:all_users,new_sign_up,specific_user',
            'expire_at' => 'required|string',
            'is_usd'    => 'required|in:is_usd,percentage',
            'user_id'   => 'sometimes|nullable|email|exists:users,email',
        ],[],[
            'quantity'  => trans('admin.quantity'),
            'reward'    => trans('admin.reward'),
            'amount'    => trans('admin.amount'),
            'rules'     => trans('admin.rules'),
            'expire_at' => trans('admin.expire_at'),
            'is_usd'    => trans('admin.is_usd'),
            'user_id'   => trans('admin.user_id'),
        ]);
        dispatch(new CouponJob($data));
        \Alert::success(trans('admin.successfuly'), trans('admin.successfuly'));
        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Coupon::findOrFail($id);
        $row->delete();
        \Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route('coupons.index');
    }
    public function destory_all(Request $request)
    {
        if(request()->has('item') && $request->item != '') {
            if(is_array($request->item)) {
                foreach($request->item as $d) {
                    $row = Coupon::findOrFail($d);
                    $row->delete();
                }
            } else {
                $row = Coupon::findOrFail($request->item);
                $row->delete();
            }
        }
        \Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route('coupons.index');
    }
}
