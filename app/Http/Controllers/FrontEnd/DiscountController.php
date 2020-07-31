<?php

namespace App\Http\Controllers\FrontEnd;

use Alert;
use App\Discount;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $model = '';
    protected $path = 'discounts';
    protected $route = 'discounts';

    public function __construct()
    {
        $this->middleware(['auth', 'role:seller']);
        $this->model = Discount::class;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (!isset(Product::where('id', $id)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first()->discount)) {
            $product = \App\Product::findOrFail($id);
            return view('FrontEnd.sellers.discounts.create', ['id' => $product->id]);
        } else {
            return redirect()->route('seller_discount_edit', $id);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if (!isset(Product::where('id', $id)->where('owner', 'for_seller')->where('user_id', auth()->user()->id)->first()->discount)) {
            $data = $this->validate(request(), [
                'condition'      => 'required|string',
                'start_at'       => 'required|string',
                'daily'          => 'required|string',
                'expire_at'      => 'required|string',
                'amount'         => 'required|numeric',
                'max_quantity'   => 'required|numeric',
                'buy_x_quantity' => 'sometimes|nullable|numeric',
                'y_quantity'     => 'sometimes|nullable|numeric',
                'product_y'      => 'sometimes|nullable|numeric',

            ], [], [
                'condition'      => trans('admin.condition'),
                'daily'          => trans('admin.daily'),
                'start_at'       => trans('admin.start_at'),
                'expire_at'      => trans('admin.expire_at'),
                'amount'         => trans('admin.amount'),
                'max_quantity'   => trans('admin.max_quantity'),
                'buy_x_quantity' => trans('admin.buy_x_quantity'),
                'y_quantity'     => trans('admin.y_quantity'),
                'product_y'      => trans('admin.product_y'),
            ]);
            $product = \App\Product::findOrFail($id)->discount()->delete();
            $data['product_id'] = $id;
            $create = $this->model::create($data);
            Alert::success(trans('admin.added'), trans('admin.success_record'));
            return redirect()->route('seller_frontend_products');
        } else {
            return $this->update($request->all(), $id);
        }
    }

    public function edit($id)
    {
        $rows = Product::findOrFail($id);
        return view('FrontEnd.sellers.discounts.edit', ['rows' => $rows]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'condition'      => 'required|string',
            'daily'          => 'required|string',
            'start_at'       => 'required|string',
            'expire_at'      => 'required|string',
            'amount'         => 'required|numeric',
            'max_quantity'   => 'required|numeric',
            'buy_x_quantity' => 'sometimes|nullable|numeric',
            'y_quantity'     => 'sometimes|nullable|numeric',
            'product_y'      => 'sometimes|nullable|numeric',

        ], [], [
            'condition'      => trans('admin.condition'),
            'daily'          => trans('admin.daily_deals_section'),
            'start_at'       => trans('admin.start_at'),
            'expire_at'      => trans('admin.expire_at'),
            'amount'         => trans('admin.amount'),
            'max_quantity'   => trans('admin.max_quantity'),
            'buy_x_quantity' => trans('admin.buy_x_quantity'),
            'y_quantity'     => trans('admin.y_quantity'),
            'product_y'      => trans('admin.product_y'),
        ]);
        $data['product_id'] = $id;
        \App\Product::findOrFail($id)->discount()->update($data);
        Alert::success(trans('admin.saved'), trans('admin.success_record'));
        return redirect()->route('seller_frontend_products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = $this->model::findOrFail($id);
        $row->delete();
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->route . '.index');
    }
    public function destory_all(Request $request)
    {
        if (request()->has('item') && $request->item != '') {
            if (is_array($request->item)) {
                foreach ($request->item as $d) {
                    $row = $this->model::findOrFail($d);
                    $row->delete();
                }
            } else {
                $row = $this->model::findOrFail($request->item);
                $row->delete();
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->route . '.index');
    }
}
