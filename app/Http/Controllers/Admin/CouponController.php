<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CouponDatatable;
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
            'amount'    => 'required|numeric',
            'rules'     => 'sometimes|nullable|in:all_users,new_sign_up,specific_user',
            'expire_at' => 'required|string',
            'is_usd'    => 'required|in:is_usd,percentage',
            'user_id'   => 'required|email|exists:users,email',
        ],[],[
            'quantity'  => trans('admin.quantity'),
            'reward'    => trans('admin.reward'),
            'amount'    => trans('admin.reward'),
            'rules'     => trans('admin.rules'),
            'expire_at' => trans('admin.expire_at'),
            'is_usd'    => trans('admin.is_usd'),
            'user_id'   => trans('admin.user_id'),
        ]);
        $expire_at = (!empty($data['expire_at']))?$data['expire_at']:NULL;
        $quantity = (!empty($data['quantity']))?$data['quantity']:NULL;
        $codeS = \Promocodes::create($data['amount'], $data['reward'], [],$expire_at, $quantity);
        if(is_array($codeS->toArray())) {
            foreach($codeS as $code) {
                Coupon::where('code', $code['code'])->where('reward', $code['reward'])->first()->update([
                    'rules'   => (!empty($data['rules']))?$data['rules']:'all_users',
                    'is_usd'  => ($data['is_usd'] === 'is_usd')?1:0,
                    'user_id' => (!empty($data['user_id']) && !empty($data['rules']) && $data['rules'] == 'specific_user')?User::where('email', $data['user_id'])->first()->id:NULL
                ]);
            }
        } else {
            Coupon::where('code', $codeS['code'])->where('reward', $codeS['reward'])->first()->update([
                'rules'   => (!empty($data['rules']))?$data['rules']:'all_users',
                'is_usd'  => ($data['is_usd'] === 'is_usd') ? 1 : 0,
                'user_id' => (!empty($data['user_id']) && !empty($data['rules']) && $data['rules'] == 'specific_user')?User::where('email', $data['user_id'])->first()->id:NULL
            ]);
        }
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
