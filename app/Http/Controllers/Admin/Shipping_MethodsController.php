<?php

namespace App\Http\Controllers\Admin;

use App\Shipping_methods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingMethodsDatatable;
use Alert;
use Illuminate\Support\Str;
class Shipping_MethodsController extends Controller
{
    protected $model        = '';
    protected $path         = 'methods';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model        = Shipping_methods::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingMethodsDatatable $datatable)
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
        $validator          = \JsValidator::make([
            'name'          => 'required|string|max:191',
            'value'         => 'required|numeric',
            'company_id'    => 'required|numeric',
            'zone_id'       => 'required|numeric',
            'status'        => 'required|numeric',
            'rule'          => 'required|string',
            'display_text'  => 'sometimes|nullable|string',
            'weight'        => 'sometimes|nullable|numeric'

        ]);
        return view('Admin.'.$this->path.'.create',
            [
                'title' => trans('admin.create'),
                'validator' =>$validator
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data               = $this->validate(request(), [
            'name'          => 'required|string|max:191',
            'value'         => 'required|numeric',
            'company_id'    => 'required|numeric',
            'zone_id'       => 'required|numeric',
            'status'        => 'required|numeric',
            'rule'          => 'required|string',
            'display_text'  => 'sometimes|nullable|string',
            'weight'        => 'sometimes|nullable|numeric'

        ],[],[
            'name'            => trans('admin.name'),
            'value'           => trans('admin.value'),
            'company_id'      => trans('admin.company_id'),
            'zone_id'         => trans('admin.zone_id'),
            'weight'         => trans('admin.weight'),
            'status'          => trans('admin.status'),
            'rule'            => trans('admin.rule'),
            'display_text'    => trans('admin.display_text')
        ]);
        $this->model::create($data);
        Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route($this->path . '.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rows               = $this->model::findOrFail($id);
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
        $validator          = \JsValidator::make([
            'name'          => 'required|string|max:191',
            'value'         => 'required|numeric',
            'company_id'    => 'required|numeric',
            'zone_id'       => 'required|numeric',
            'status'        => 'required|numeric',
            'rule'          => 'required|string',
            'display_text'  => 'sometimes|nullable|string',
            'weight'        => 'sometimes|nullable|numeric'

        ]);
        $rows               = $this->model::findOrFail($id);
        return view('Admin.'.$this->path.'.edit',
            [
                'title' => trans('admin.edit'),
                'rows'=>$rows,
                'validator' => $validator
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
        $data               = $this->validate(request(), [
            'name'         => 'required|string|max:191',
            'value'        => 'required|numeric',
            'company_id'   => 'required|numeric',
            'zone_id'      => 'required|numeric',
            'status'       => 'required|numeric',
            'rule'         => 'required|string',
            'display_text' => 'sometimes|nullable|string',
            'weight'       => 'sometimes|nullable|numeric'
        ],[],[
            'name'         => trans('admin.name'),
            'value'        => trans('admin.value'),
            'company_id'   => trans('admin.company_id'),
            'zone_id'      => trans('admin.zone_id'),
            'weight'       => trans('admin.weight'),
            'status'       => trans('admin.status'),
            'rule'         => trans('admin.rule'),
            'display_text' => trans('admin.display_text')
        ]);
        $this->model::where('id', $id)->update($data);

        Alert::success(trans('admin.updated'), trans('admin.success_record'));
        return redirect()->route($this->path . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row                = $this->model::findOrFail($id);
        $row->delete();
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->path . '.index');
    }
    public function destory_all(Request $request)
    {
        if(request()->has('item') && $request->item != '') {
            if(is_array($request->item)) {
                foreach($request->item as $d) {
                    $row    = $this->model::findOrFail($d);
                    $row->delete();
                }
            } else {
                $row        = $this->model::findOrFail($request->item);
                $row->delete();
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->path . '.index');
    }
}
