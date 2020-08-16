<?php

namespace App\Http\Controllers\Admin\cms;

use App\Testimonials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TestimonailsDatatable;
use Image;
use RealRashid\SweetAlert\Facades\Alert;

class TestimonialController extends Controller
{

    protected $model = '';
    protected $path  = 'testimonials';
    protected $route = 'testimonials';

    public function __construct()
    {
        /* $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy'); */
        $this->model = Testimonials::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TestimonailsDatatable $datatable)
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
            'name'         => 'required|string|max:100',
            'job_title'    => 'required|min:3',
            'image'        => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'project_type' => 'required',
            'comment'      => 'required',
        ],[],[
            'name'         => trans('admin.name'),
            'job_title'    => trans('admin.job_title'),
            'image'        => trans('admin.image'),
            'comment'      => trans('admin.comment'),
            'project_type' => trans('admin.project_type'),
        ]);


        if(!empty($data['image'])) {
            $img =  upload($data['image'], $this->path);
            $data['image'] = $img;
        }

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
            'name'         => 'required|string|max:100',
            'job_title'    => 'required|min:3',
            'image'        => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'project_type' => 'required',
            'comment'      => 'required',
        ],[],[
            'name'         => trans('admin.name'),
            'job_title'    => trans('admin.job_title'),
            'image'        => trans('admin.image'),
            'comment'      => trans('admin.comment'),
            'project_type' => trans('admin.project_type'),
        ]);
        if(!empty($data['image'])) {
            $image = $this->model::find($id)->image;
            \Storage::delete($image);
            $img           = upload($data['image'], $this->path);
            $data['image'] = $img;
        }

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
