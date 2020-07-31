<?php

namespace App\Http\Controllers\Admin;

use App\Tradmark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use App\DataTables\TradmarkDataTable;
use RealRashid\SweetAlert\Facades\Alert;
class TradmarkController extends Controller
{
    protected $model = '';
    protected $path  = 'tradmarks';
    protected $route = 'tradmarks';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Tradmark::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TradmarkDataTable $datatable)
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
        $data = $this->validate(request(), [
            'name_en' => 'required|string',
            'logo'    => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'slug'    => 'required|string',
        ],[], [
            'name_en' => trans('admin.name_en'),
            'logo'    => trans('admin.logo'),
            'slug'    => trans('admin.slug')
        ]);

        if(!empty($data['logo'])) {
            $filenamewithextension = $data['logo']->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['logo']->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/tradmarks/thumbnail/'. $filenametostore, fopen($data['logo'], 'r+'));

            //Resize image here
            $thumbnailpath = public_path('storage/tradmarks/thumbnail/'.$filenametostore);
           $logo = Image::make($thumbnailpath)->resize(180, 180, function($constraint) {
              $constraint->aspectRatio();
            });
            $logo->save($thumbnailpath);
            $data['logo'] = 'public/tradmarks/thumbnail/'.$filenametostore;
        }
        $create = $this->model::create([
            'name' => $data['name_en'],
            'logo' => $data['logo'],
            'slug' => \Str::slug($data['slug'])
        ]);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $create->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
        };
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
        return view('Admin.'.$this->path.'.show', ['title' => 'Show ' .  $this->path, 'rows'=>$rows]);
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
            'name_en' => 'required|string',
            'slug'    => 'required|string',
            'logo'    => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
        ],[], [
            'name_en' => trans('admin.name_en'),
            'slug'    => trans('admin.slug'),
            'logo'    => trans('admin.logo')
        ]);

        if(!empty($data['logo'])) {
            $image = $this->model::find($id)->logo;
            \Storage::delete($image);
            $filenamewithextension = $data['logo']->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['logo']->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/tradmarks/thumbnail/'. $filenametostore, fopen($data['logo'], 'r+'));

            //Resize image here
            $thumbnailpath = public_path('storage/tradmarks/thumbnail/'.$filenametostore);
            $logo = Image::make($thumbnailpath)->resize(180, 180, function($constraint) {
              $constraint->aspectRatio();
            });
            $logo->save($thumbnailpath);
            $data['logo'] = 'public/tradmarks/thumbnail/'.$filenametostore;
        }
        $this->model::where('id', $id)->update([
            'name'  => $data['name_en'],
            'logo' => $data['logo'],
            'slug' => \Str::slug($data['slug'])

        ]);
        $update = $this->model::find($id);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $update->setTranslation('name', $localeCode, $request['name_'.$localeCode])->save();
        };
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
        \Storage::delete($row->logo);
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
