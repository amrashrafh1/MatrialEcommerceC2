<?php

namespace App\Http\Controllers\Admin;

use App\Events\notificationEvent;
use App\Notifications\NotificationSent;
use App\SellerInfo;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StoresDatatable;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
class StoreController extends Controller
{
    protected $model = '';
    protected $path  = 'stores';
    protected $route = 'stores';

    public function __construct()
    {
        //create read update delete
        /* $this->middleware(['permission:read-stores'])->only('index');
        $this->middleware(['permission:create-stores'])->only('create');
        $this->middleware(['permission:delete-stores'])->only('destroy'); */

        $this->model = User::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $seller)
    {
        $store     = $seller->stores()->with('seller')->get();
        $datatable = new StoresDatatable($store);
        return $datatable->render('Admin.'.$this->path.'.index', ['title' => trans($this->path . ' Table'), 'seller' => $seller]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $seller)
    {
        return view('Admin.'.$this->path.'.create',['title' => trans('admin.create'), 'seller' =>$seller]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,User $seller)
    {
        $data = $this->validate(request(), [
            'country_id'  => 'required|numeric|exists:countries,id',
            'name'        => 'required|string|max:191,unique:seller_infos',
            'email'       => 'required|email',
            'city'        => 'required|string',
            'state'       => 'sometimes|nullable|string',
            'address1'    => 'required|string',
            'address2'    => 'sometimes|nullable|string',
            'address3'    => 'sometimes|nullable|string',
            'phone1'      => 'required|string',
            'phone2'      => 'sometimes|nullable|string',
            'phone3'      => 'sometimes|nullable|string',
            'image'       => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'type'        => 'required|in:0,1',                                                 // 0 = individual || 1 = business
            'business'    => 'required|string',
            'description' => 'required|min:3|max:1000',
            'seller'      => 'required|email|exists:users,email',
        ], [], [
            'country_id'  => trans('admin.country'),
            'name'        => trans('admin.name'),
            'email'       => trans('admin.email'),
            'city'        => trans('admin.city'),
            'state'       => trans('admin.state'),
            'address1'    => trans('admin.address1'),
            'address2'    => trans('admin.address2'),
            'address3'    => trans('admin.address3'),
            'phone1'      => trans('admin.phone1'),
            'phone2'      => trans('admin.phone2'),
            'phone3'      => trans('admin.phone3'),
            'image'       => trans('admin.image'),
            'type'        => trans('admin.type'),
            'business'    => trans('admin.business'),
            'description' => trans('admin.description'),
            'seller'      => trans('admin.seller'),
        ]);
        if($data['seller']) {
            $seller = User::where('email', $data['seller'])->first();
            if($seller) {
                if(!$seller->hasRole('seller')) {
                    $seller->attachRole('seller');
                }
                $img = '';
                if (!empty($data['image'])) {
                    $img = upload($data['image'], 'stores', 1446, 409);
                }
                $data['slug']      = \Str::slug($data['name']);
                $data['image']     = $img;
                $data['seller_id'] = $seller->id;
                $data['approved']  = 1;

                SellerInfo::create(\Arr::except($data, 'seller'));
                Alert::success(trans('admin.added'), trans('admin.success_record'));

                return redirect()->route('seller.stores.index', $seller->id);
            }
        }
        return redirect()->route('seller.stores.index', $seller->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $row
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $seller, $id)
    {
        $row = SellerInfo::findOrFail($id);
        \Storage::delete($row->image);
        $row->delete();
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route('seller.stores.index', $seller->id);
    }
    public function destory_all(Request $request, User $seller)
    {
        if (request()->has('item') && $request->item != '') {
            if (is_array($request->item)) {
                foreach ($request->item as $d) {
                    $row = SellerInfo::findOrFail($d);
                    \Storage::delete($row->image);
                    $row->delete();
                }
            } else {
                $row = SellerInfo::findOrFail($request->item);
                \Storage::delete($row->image);
                $row->delete();
            }
        }
        Alert::success(trans('admin.deleted'), trans('admin.deleted'));
        return redirect()->route('seller.stores.index', $seller->id);
    }
}
