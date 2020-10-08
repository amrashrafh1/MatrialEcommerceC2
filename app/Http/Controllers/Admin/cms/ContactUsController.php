<?php

namespace App\Http\Controllers\Admin\cms;

use App\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ContactUsDatatable;
use Image;
use RealRashid\SweetAlert\Facades\Alert;

class ContactUsController extends Controller
{

    protected $model = '';
    protected $path  = 'contact_us';
    protected $route = 'contact_us';

    public function __construct()
    {
        /* $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy'); */
        $this->model = ContactUs::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ContactUsDatatable $datatable)
    {
        return $datatable->render('Admin.cms.'.$this->path.'.index', ['title' => $this->path . ' Table']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.cms.'.$this->path.'.create',['title' => 'Create ' . $this->path]);
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
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required',
            'mobile'  => 'required',
            'subject' => 'required',
        ],[],[
            'name'    => trans('admin.name'),
            'email'   => trans('admin.email'),
            'message' => trans('admin.message'),
            'mobile'  => trans('admin.mobile'),
            'subject' => trans('admin.subject'),
        ]);

        $create = $this->model::create($data);

        Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route($this->route.'.index');
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
        return view('Admin.cms.'.$this->path.'.show', ['title' => 'Show ' .  $this->path, 'rows'=>$rows]);
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
        return view('Admin.cms.'.$this->path.'.edit', ['title' => 'Edit ' . $this->path, 'rows'=>$rows]);
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
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'message' => 'required',
            'mobile'  => 'required',
            'subject' => 'required',
        ],[],[
            'name'    => trans('admin.name'),
            'image'   => trans('admin.image'),
            'message' => trans('admin.message'),
            'subject' => trans('admin.subject'),
            'mobile'  => trans('admin.mobile'),
        ]);

        $this->model::where('id', $id)->update($data);

        Alert::success(trans('admin.updated'), trans('admin.success_record'));
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
        \Storage::delete($row->image);
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
        return redirect()->route($this->route.'.index');
    }
}
