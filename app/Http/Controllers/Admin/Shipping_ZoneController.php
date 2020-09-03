<?php

namespace App\Http\Controllers\Admin;

use App\Zone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingZoneDatatable;
use Alert;
use Illuminate\Support\Str;
class Shipping_ZoneController extends Controller
{
    protected $model = '';
    protected $path = 'zones';

    public function __construct()
    {
       $this->middleware(['permission:read-'.$this->path])->only('index');
       $this->middleware(['permission:create-'.$this->path])->only('create');
       $this->middleware(['permission:update-'.$this->path])->only('edit');
       $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Zone::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingZoneDatatable $datatable)
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
        $validator = \JsValidator::make([
            'name'         => 'required|string|max:191',
            'country_id.*' => 'required|exists,countries'
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
      //  dd($request->all());
        $data = $this->validate(request(), [
            'name' => 'required|string|max:191',
            'country_id' => 'required|array',
            'company_id'  => 'required|array'
        ],[],[
            'name' => trans('admin.name'),
            'country_id' => trans('admin.country_id'),
            'company_id' => trans('admin.company_id')
        ]);
        $create = $this->model::create(['name' => $data['name']]);
        $create->countries()->attach($data['country_id']);
        $create->shippingcompanies()->attach($data['company_id']);
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
        $validator = \JsValidator::make([
            'name' => 'required|string|max:191',
            'country_id' => 'required|array',
            'company_id'  => 'required|array'
        ]);
        $rows = $this->model::findOrFail($id);
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
        $data = $this->validate(request(), [
            'name'         => 'required|string|max:191',
            'country_id' => 'required|array',
            'company_id'  => 'required|array'
        ],[],[
            'name' => trans('admin.name'),
            'country_id' => trans('admin.country_id'),
            'company_id' => trans('admin.country_id'),
        ]);
        //dd($request->all());
        $this->model::where('id', $id)->update(['name' => $data['name']]);
        $update = $this->model::find($id);
        $update->countries()->sync($data['country_id']);
        $update->shippingcompanies()->sync($data['company_id']);
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
        $row = $this->model::findOrFail($id);
        $row->delete();
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->path . '.index');
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
        return redirect()->route($this->path . '.index');
    }
}
