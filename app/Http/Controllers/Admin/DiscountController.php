<?php

namespace App\Http\Controllers\Admin;

use App\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\DiscountDatatable;
use RealRashid\SweetAlert\Facades\Alert;
class DiscountController extends Controller
{
    protected $model = '';
    protected $path  = 'discounts';
    protected $route = 'discounts';

    public function __construct()
    {
        /* $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy'); */
        $this->model = Discount::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DiscountDatatable $datatable)
    {
        return $datatable->render('Admin.'.$this->path.'.index', ['title' => $this->path . ' Table']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.'.$this->path.'.create',['title' => 'Create ' . $this->path]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  dd(request()->all());
        $data = $this->validate(request(), [
            'condition'      => 'required|string',
            'start_at'       => 'required|string',
            'daily'          => 'required|string',
            'expire_at'      => 'required|string',
            'amount'         => 'required|numeric',
            'max_quantity'   => 'required|numeric',
            'buy_x_quantity' => 'sometimes|nullable|numeric',
            'y_quantity'     => 'sometimes|nullable|numeric',
            'product_id'     => 'sometimes|nullable|numeric',
            'product_y'      => 'sometimes|nullable|numeric',

        ],[],[
            'condition'      => trans('admin.condition'),
            'daily'          => trans('admin.daily'),
            'start_at'       => trans('admin.start_at'),
            'expire_at'      => trans('admin.expire_at'),
            'amount'         => trans('admin.amount'),
            'max_quantity'   => trans('admin.max_quantity'),
            'buy_x_quantity' => trans('admin.buy_x_quantity'),
            'y_quantity'     => trans('admin.y_quantity'),
            'product_id'     => trans('admin.product_id'),
            'product_y'      => trans('admin.product_y'),
        ]);
        $product = \App\Product::findOrFail($data['product_id'])->discount()->delete();
        $create = $this->model::create($data);
        Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route($this->route.'.index');
    }


    public function edit($id)
    {
        $rows = $this->model::findOrFail($id);
        return view('Admin.'.$this->path.'.edit', ['title' => 'Edit ' . $this->path, 'rows'=>$rows]);
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
            'product_id'     => 'sometimes|nullable|numeric',
            'product_y'      => 'sometimes|nullable|numeric',

        ],[],[
            'condition'      => trans('admin.condition'),
            'daily'          => trans('admin.daily_deals_section'),
            'start_at'       => trans('admin.start_at'),
            'expire_at'      => trans('admin.expire_at'),
            'amount'         => trans('admin.amount'),
            'max_quantity'   => trans('admin.max_quantity'),
            'buy_x_quantity' => trans('admin.buy_x_quantity'),
            'y_quantity'     => trans('admin.y_quantity'),
            'product_id'     => trans('admin.product_id'),
            'product_y'      => trans('admin.product_y'),
        ]);
        $this->model::where('id', $id)->update($data);
        Alert::success(trans('admin.saved'), trans('admin.success_record'));
        return redirect()->route($this->route.'.index');
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
        return redirect()->route($this->route.'.index');
    }
    public function destory_all(Request $request)
    {
        if(request()->has('item') && $request->item != '') {
            if(is_array($request->item)) {
                foreach($request->item as $d) {
                    $row = $this->model::findOrFail($d);
                    $row->delete();
                }
            } else {
                $row = $this->model::findOrFail($request->item);
                $row->delete();
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->route.'.index');
    }
}
