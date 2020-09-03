<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDatatable;
use Alert;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    protected $model = '';
    protected $path = 'categories';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Category::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryDataTable $datatable)
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
        $validatorCategoryForm = \JsValidator::make([
            'name_en'        => 'sometimes|nullable|string|max:191',
            'slug'           => 'required|string|max:191|unique:categories',
            'category_id'    => 'sometimes|nullable|numeric',
            'description_en' => 'required|string',
            'status'         => 'required|numeric',
            'image'          => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
        ]);
        return view('Admin.'.$this->path.'.create',
            [
            'title' => trans('admin.create'),
            'validatorCategoryForm' =>$validatorCategoryForm
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
        $data = $this->validate(request(), [
            'name_en'        => 'sometimes|nullable|string|max:191',
            'slug'           => 'required|string|max:191|unique:categories',
            'category_id'    => 'sometimes|nullable|numeric',
            'description_en' => 'required|string',
            'status'         => 'required|numeric',
            'image'          => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
        ],[],[
            'name_en'     => trans('admin.name_en'),
            'category_id' => trans('admin.category_id'),
            'slug'        => trans('admin.slug'),
            'description' => trans('admin.description'),
            'status'      => trans('admin.status'),
            'image'       => trans('admin.image')
        ]);
        $img = '';
        if(!empty($request['image'])) {
            $img =  upload($request['image'], $this->path, 1446,409);
        }
        $create = $this->model::create([
            'name'        => $data['name_en'],
            'slug'        => \Str::slug($data['slug']),
            'category_id' => $data['category_id'],
            'description' => $data['description_en'],
            'status'      => $data['status'],
            'image'       => (!empty($img))?$img: NULL,
        ]);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $create->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
            $create->setTranslation('description', $localeCode, $request['description_'.$localeCode])->save();

        };
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
        $validatorCategoryForm = \JsValidator::make([
            'name_en'        => 'sometimes|nullable|string|max:191',
            'slug'           => 'required|string|max:191|unique:categories,slug,'.$id,
            'category_id'    => 'sometimes|nullable|numeric',
            'description_en' => 'required|string',
            'status'         => 'required|numeric',
            'image'          => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',

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
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'name_en'        => 'required|string|max:255',
            'category_id'         => 'sometimes|nullable|string|max:191',
            'slug'           => 'required|string|max:191|unique:categories,slug,'.$id,
            'description_en' => 'required|string',
            'status'         => 'required|numeric',
            'image'          => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
        ],[],[
            'name_en'     => trans('admin.name_en'),
            'category_id'      => trans('admin.category_id'),
            'slug'        => trans('admin.slug'),
            'description' => trans('admin.description'),
            'status'      => trans('admin.status'),
            'image'       => trans('admin.image')
        ]);
        $img = '';
        if(!empty($request['image'])) {
            $image = $this->model::find($id)->image;
            \Storage::delete($image);
            $img =  upload($request['image'], $this->path,1446,409);
        }else {
            $img = $this->model::find($id)->image;
        }
        $this->model::where('id', $id)->update([
            'name'        => $data['name_en'],
            'category_id'      => $data['category_id'],
            'slug'        => \Str::slug($data['slug']),
            'description' => $data['description_en'],
            'status'      => $data['status'],
            'image'       => $img,

        ]);
        $update = $this->model::find($id);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $update->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
            $update->setTranslation('description', $localeCode, $request['description_'.$localeCode])->save();
        };
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
