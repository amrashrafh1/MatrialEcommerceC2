<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\OrderDatatable;
use Alert;
use Illuminate\Support\Str;
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
        $validatorCategoryForm = \JsValidator::make([
            'name_en' => 'sometimes|nullable|string|max:191',
            'slug' => 'required|string|max:191|unique:categories,slug,'.$id,
            'cat_id'  => 'sometimes|nullable|numeric',
        ]);
        $rows = $this->model::findOrFail($id);
        return view('Admin.'.$this->path.'.edit',
            [
                'title' => trans('admin.edit'),
                'rows'=>$rows,
                'validatorCategoryForm' => $validatorCategoryForm
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(request()->has('item') && $request->item != '') {
            if(is_array($request->item)) {
                foreach($request->item as $d) {
                    $row = $this->model::where('id', $d)->first();
                    $row->update(['status' => $request->status]);
                }
            } else {
                $row = $this->model::where('id',$request->item)->first();
                $row->update(['status' => $request->status]);
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->path . '.index');
    }

}
