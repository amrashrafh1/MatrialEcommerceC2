<?php

namespace App\Http\Controllers\Admin;

use App\Events\notificationEvent;
use App\Notifications\NotificationSent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SellerDatatable;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
class SellerController extends Controller
{
    protected $model = '';
    protected $path  = 'sellers';
    protected $route = 'seller';

    public function __construct()
    {
        //create read update delete
     //   $this->middleware(['permission:read-sellers'])->only('index');
    //    $this->middleware(['permission:create-sellers'])->only('create');
    //    $this->middleware(['permission:update-sellers'])->only('edit');
   //     $this->middleware(['permission:delete-sellers'])->only('destroy');

        $this->model = User::class;
        $this->middleware('image-sanitize');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SellerDatatable $datatable)
    {
        return $datatable->render('Admin.'.$this->path.'.index', ['title' => trans($this->path . ' Table')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|unique:users|max:255',
            'password'      => 'required|string|min:8|confirmed',
            'phone'         => 'sometimes|nullable',
            'address'       => 'sometimes|nullable|string',
            'image'         => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'last_name'     => 'required|string|max:255'

        ],[],[
            'name'        => trans('admin.name'),
            'email'       => trans('admin.email'),
            'password'    => trans('admin.password'),
            'phone'       => trans('admin.phone'),
            'address'     => trans('admin.address'),
            'image'       => trans('admin.image'),
            'last_name'   => trans('admin.last_name')
        ]);
        $img = '';
        $data['password'] = bcrypt(request('password'));
        if(!empty($data['image'])) {
            $img = upload($data['image'], 'users');
        }
        $user = $this->model::create([
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'address'   => $data['address'],
            'image'     => $img,
            'phone'     => $data['phone'],
            'last_name' => $data['last_name']
        ]);
        $user->attachRole('seller');
        $users = User::whereRoleIs('superadministrator')->orWhereRoleIs('administrator')->get();
        Notification::send($users, new NotificationSent('New Seller was created'));
        event(new notificationEvent('New Seller was created'));
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
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255',
            'password'      => 'sometimes|nullable|min:8|confirmed',
            'phone'         => 'sometimes|nullable|string',
            'address'       => 'sometimes|nullable|string',
            'image'         => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'last_name' => 'required|string|max:255'

        ],[],[
            'name'        => trans('admin.name'),
            'email'       => trans('admin.email'),
            'password'    => trans('admin.password'),
            'phone'       => trans('admin.phone'),
            'address'     => trans('admin.address'),
            'image'       => trans('admin.image'),
            'last_name' => trans('admin.last_name')
        ]);
        //dd($data);
        if ($data['password'] != null) {
            $data['password'] = bcrypt(request('password'));
        } else {
            $password = User::find($id)->password;
            $data['password'] = $password;
        }
        if(!empty($data['image'])) {
            $image = $this->model::find($id)->image;
            \Storage::delete($image);
            $filenamewithextension = $data['image']->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['image']->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/users/'. $filenametostore, fopen($data['image'], 'r+'));
            // \Storage::put('public/users/thumbnail/'. $filenametostore, fopen($data['image'], 'r+'));

            //Resize image here
            // $thumbnailpath = public_path('storage/users/thumbnail/'.$filenametostore);
            // $image = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            //   $constraint->aspectRatio();
            //  });
            //  $image->save($thumbnailpath);
            $data['image'] = 'public/users/'.$filenametostore;
            $this->model::where('id', $id)->update([
                'image'     => $data['image'],
            ]);
        }
        $this->model::where('id', $id)->update([
            'name'      => $data['name'],
            'last_name' => $data['last_name'],
            'email'     => $data['email'],
            'password'  => $data['password'],
            'address'   => $data['address'],
            'phone'     => $data['phone'],
            'last_name' => $data['last_name']
        ]);
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
        @$row->delete();
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route('admins.index');
    }
    public function destory_all(Request $request)
    {
        if(request()->has('item') && $request->item != '') {
            if(is_array($request->item)) {
                foreach($request->item as $d) {
                    $row = $this->model::findOrFail($d);
                    @$row->delete();
                }
            } else {
                $row = $this->model::findOrFail($request->item);
                @$row->delete();
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route($this->route.'.index');
    }
}
