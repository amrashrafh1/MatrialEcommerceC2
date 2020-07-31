<?php

namespace App\Http\Controllers\Admin;

use App\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ManufacturerDatatable;
use Image;
use RealRashid\SweetAlert\Facades\Alert;
class ManufacturerController extends Controller
{
    protected $model = '';
    protected $path  = 'manufacturers';
    protected $route = 'manufacturers';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Manufacturer::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufacturerDatatable $datatable)
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
            'name_en'      => 'required|string|max:255',
            'facebook'     => 'sometimes|nullable|url',
            'twitter'      => 'sometimes|nullable|url',
            'website'      => 'sometimes|nullable|url',
            'contact_name' => 'sometimes|nullable|string',
            'address'      => 'sometimes|nullable|string',
            'mobile'       => 'sometimes|nullable|string',
            'email'        => 'sometimes|nullable|string',
            'icon'         => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'country_id'   => 'required|numeric'

        ],[],[
            'name_en'      => trans('admin.name_en'),
            'facebook'     => trans('admin.facebook'),
            'twitter'      => trans('admin.twitter'),
            'website'      => trans('admin.website'),
            'contact_name' => trans('admin.contact_name'),
            'address'      => trans('admin.address'),
            'mobile'       => trans('admin.mobile'),
            'email'        => trans('admin.email'),
            'country_id'   => trans('admin.country_id')
        ]);
        if(!empty($data['icon'])) {
            $filenamewithextension = $data['icon']->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['icon']->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/manufacturers/'. $filenametostore, fopen($data['icon'], 'r+'));
            \Storage::put('public/manufacturers/thumbnail/'. $filenametostore, fopen($data['icon'], 'r+'));

            //Resize image here
            $thumbnailpath = public_path('storage/manufacturers/thumbnail/'.$filenametostore);
            $icon = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
              $constraint->aspectRatio();
            });
            $icon->save($thumbnailpath);
            $data['icon'] = 'public/manufacturers/'.$filenametostore;
        }
        $create = $this->model::create([
            'name'         => $data['name_en'],
            'email'        => (empty($data['email']))?NULL:$data['email'],
            'mobile'       => (empty($data['mobile']))?NULL:$data['mobile'],
            'facebook'     => (empty($data['facebook']))?NULL:$data['facebook'],
            'country_id'   => (empty($data['country_id']))?NULL:$data['country_id'],
            'twitter'      => (empty($data['twitter']))?NULL:$data['twitter'],
            'address'      => (empty($data['address']))?NULL:$data['address'],
            'website'      => (empty($data['website']))?NULL:$data['website'],
            'contact_name' => (empty($data['contact_name']))?NULL:$data['contact_name'],
            'icon'         => (empty($data['icon']))?NULL:$data['icon']
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
            'facebook'        => 'sometimes|nullable|url',
            'twitter'         => 'sometimes|nullable|url',
            'website'         => 'sometimes|nullable|url',
            'contact_name_en' => 'sometimes|nullable|string',
            'address'         => 'sometimes|nullable|string',
            'mobile'          => 'sometimes|nullable|string',
            'email'           => 'sometimes|nullable|string',
            'icon'            => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'country_id'      => 'required|numeric'

        ],[],[
            'facebook'     => trans('admin.facebook'),
            'twitter'      => trans('admin.twitter'),
            'website'      => trans('admin.website'),
            'contact_name' => trans('admin.contact_name'),
            'address'      => trans('admin.address'),
            'mobile'       => trans('admin.mobile'),
            'email'        => trans('admin.email'),
            'icon'         => trans('admin.icon'),
            'country_id'   => trans('admin.country_id')
        ]);

        $name_en = $this->validate(request(), [
            'name_en'         => 'required|string|max:255'
        ],[],[
            'name_en'     => trans('admin.name_en'),
            ]);
        if(!empty($data['icon'])) {
            $image = $this->model::find($id)->icon;
            \Storage::delete($image);
            $filenamewithextension = $data['icon']->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['icon']->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/manufacturers/'. $filenametostore, fopen($data['icon'], 'r+'));
           // \Storage::put('public/manufacturers/thumbnail/'. $filenametostore, fopen($data['icon'], 'r+'));

            //Resize image here
           // $thumbnailpath = public_path('storage/manufacturers/thumbnail/'.$filenametostore);
           // $icon = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            //  $constraint->aspectRatio();
           // });
           // $icon->save($thumbnailpath);
            $data['icon'] = 'public/manufacturers/'.$filenametostore;
        }
        $this->model::where('id', $id)->update($data);
        $this->model::where('id', $id)->update([
            'name'         => $name_en,
            ]);
        $update = Manufacturer::find($id);
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
