<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CountryDataTable;
use Image;
use RealRashid\SweetAlert\Facades\Alert;
class CountryController extends Controller
{
    protected $model = '';
    protected $path  = 'countries';
    protected $route = 'countries';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Country::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountryDataTable $datatable)
    {
        return $datatable->render('Admin.'.$this->path.'.index', ['title' => $this->path . ' Table']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/* public function create()
    {
        return view('Admin.'.$this->path.'.create',['title' => 'Create ' . $this->path]);
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   /* public function store(Request $request)
    {
        $data = $this->validate(request(), [
            'country_name_en' => 'required|string|max:255',
            'mob'             => 'required|string',
            'code'            => 'required|string',
            'logo'            => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000'

        ],[],[
            'country_name_en' => trans('admin.country_name_en'),
            'mob'             => trans('admin.mob'),
            'code'            => trans('admin.code'),
            'logo'            => trans('admin.logo')
        ]);
        if(!empty($data['logo'])) {
            $filenamewithextension = $data['logo']->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['logo']->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/'.$this->path.'/'. $filenametostore, fopen($data['logo'], 'r+'));
         //   \Storage::put('public/'.$this->path.'/thumbnail/'. $filenametostore, fopen($data['logo'], 'r+'));

            //Resize image here
          //  $thumbnailpath = public_path('storage/'.$this->path.'/thumbnail/'.$filenametostore);
           // $logo = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
           //   $constraint->aspectRatio();
          //  });
          //  $logo->save($thumbnailpath);
            $data['logo'] = 'public/'.$this->path.'/'.$filenametostore;
        }
        $create = $this->model::create([
            'country_name' => $data['country_name_en'],
            'mob'          => $data['mob'],
            'code'         => $data['code'],
            'logo'         => (empty($data['logo']))?NULL:$data['logo']
        ]);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $create->setTranslation('country_name', $localeCode, $request['country_name_'.$localeCode])->save();
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
   /* public function edit($id)
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
   /* public function update(Request $request, $id)
    {
        $data = $this->validate(request(), [
            'country_name_en' => 'required|string|max:255',
            'mob'             => 'required|string',
            'code'            => 'required|string',
            'logo'            => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000'

        ],[],[
            'country_name_en' => trans('admin.country_name_en'),
            'mob'             => trans('admin.mob'),
            'code'            => trans('admin.code'),
            'logo'            => trans('admin.logo')
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

            \Storage::put('public/'.$this->path.'/'. $filenametostore, fopen($data['logo'], 'r+'));
            //\Storage::put('public/'.$this->path.'/thumbnail/'. $filenametostore, fopen($data['logo'], 'r+'));

            //Resize image here
          //  $thumbnailpath = public_path('storage/'.$this->path.'/thumbnail/'.$filenametostore);
           // $logo = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            //  $constraint->aspectRatio();
           // });
           // $logo->save($thumbnailpath);
            $data['logo'] = 'public/'.$this->path.'/'.$filenametostore;
        }
        $this->model::where('id', $id)->update([
            'country_name' => $data['country_name_en'],
            'mob'          => $data['mob'],
            'code'         => $data['code'],
            'logo'         => (empty($data['logo']))?NULL:$data['logo']
        ]);
        $update = Country::find($id);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $update->setTranslation('country_name', $localeCode, $request['country_name_'.$localeCode])->save();
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
