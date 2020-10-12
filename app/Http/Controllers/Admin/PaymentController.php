<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentsDatatable;
use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    protected $model = '';
    protected $path  = 'payments';
    protected $route = 'payments';

    public function __construct()
    {
        $this->middleware(['permission:read-' . $this->path])->only('index');
        $this->middleware(['permission:create-' . $this->path])->only('create');
        $this->middleware(['permission:update-' . $this->path])->only('edit');
        $this->middleware(['permission:delete-' . $this->path])->only('destroy');
        $this->model = Payment::class;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PaymentsDatatable $datatable)
    {
        return $datatable->render('Admin.' . $this->path . '.index', ['title' => $this->path . ' Table']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.' . $this->path . '.create', ['title' => 'Create ' . $this->path]);
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
            'payment' => 'required|string|max:100',
            'countries.*' => 'required|exists:countries,id',
        ], [], [
            'payment'   => trans('admin.payment'),
            'countries' => trans('admin.countries'),
        ]);

        $create = $this->model::create(['payment' => $data['payment']]);
        $create->countries()->attach($data['countries']);
        Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route($this->route . '.index');
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
        return view('Admin.' . $this->path . '.show', ['title' => 'Show ' . $this->path, 'rows' => $rows]);
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
        return view('Admin.' . $this->path . '.edit', ['title' => 'Edit ' . $this->path, 'rows' => $rows]);
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
            'payment' => 'required|string|max:100',
            'countries.*' => 'required|exists:countries,id',
        ], [], [
            'payment'   => trans('admin.payment'),
            'countries' => trans('admin.countries'),
        ]);


        $update = $this->model::where('id', $id)->first();
        if($update) {
            $update->update(['payment'=>$data['payment']]);
            $update->countries()->sync($data['countries']);
        }
        Alert::success(trans('admin.updated'), trans('admin.success_record'));
        return redirect()->route($this->route . '.index');
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
        \Storage::delete($row->image);
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
                    \Storage::delete($row->image);
                    $row->delete();
                }
            } else {
                $row = $this->model::findOrFail($request->item);
                \Storage::delete($row->image);
                $row->delete();
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->route . '.index');
    }
}
