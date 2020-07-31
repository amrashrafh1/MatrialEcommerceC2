<?php

namespace App\Http\Controllers\Admin;

use App\Attribute_Family;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Attribute_FamilyDatatable;
use Alert;

class Attribute_FamilyController extends Controller
{
    protected $model = '';
    protected $path = 'attribute_families';

    public function __construct()
    {
        // $this->middleware(['permission:read-'.$this->path])->only('index');
        // $this->middleware(['permission:create-'.$this->path])->only('create');
        // $this->middleware(['permission:update-'.$this->path])->only('edit');
        // $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Attribute_Family::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attribute_FamilyDatatable $datatable)
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
        //dd(Category::getTranslations('name','en')->get());
        return view('Admin.'.$this->path.'.create',['title' => trans('admin.create')]);
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
            'name_en' => 'sometimes|nullable|string|max:191',
        ],[],[
            'name_en' => trans('admin.name_en'),
        ]);
        $create = $this->model::create([
            'name'  => $data['name_en']
        ]);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $create->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
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
        $rows = $this->model::findOrFail($id);
        return view('Admin.'.$this->path.'.edit', ['title' => trans('admin.edit'), 'rows'=>$rows]);
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
            'name_en' => 'required|string|max:191',
        ],[],[
            'name_en' => trans('admin.name_en'),
        ]);
        $this->model::where('id', $id)->update([
            'name'  => $data['name_en']
        ]);
        $update = $this->model::find($id);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $update->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
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
