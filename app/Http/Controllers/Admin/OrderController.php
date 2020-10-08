<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\OrderDatatable;
use Alert;
use Illuminate\Support\Str;
use Mail;
use App\Mail\OrderIdMail;
class OrderController extends Controller
{
    protected $model = '';
    protected $path = 'orders';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Order::class;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OrderDatatable $datatable)
    {
        return $datatable->render('Admin.'.$this->path.'.index', ['title' => $this->path . ' Table']);
    }



    /*** Show Order */
    public function show($id)
    {
        $rows = $this->model::findOrFail($id);
        return view('Admin.'.$this->path.'.show', ['title' => trans('admin.show'), 'rows'=>$rows]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rows = $this->model::findOrFail($id);
        return view('Admin.'.$this->path.'.edit',
            [
                'title'                 => trans('admin.edit'),
                'rows'                  => $rows,
            ]);
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
            'order_id' => 'sometimes|nullable|string',
            'status'   => 'required|string',
        ], [], [
            'order_id' => trans('admin.order_id'),
            'status'   => trans('admin.status')
        ]);
        $rows = $this->model::findOrFail($id);
        $orderid = $rows->order_id;

        $rows->update($data);

        if($data['order_id'] != $orderid) {
            Mail::to($rows->billing_email)->send(new OrderIdMail($rows->order_id));
        }
        Alert::success(trans('admin.updated'), trans('admin.success_record'));
        return redirect()->route($this->path . '.index');
    }

}
