<?php

namespace App\Http\Controllers\Admin;

use App\CMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\EventCategoryDatatable;
use RealRashid\SweetAlert\Facades\Alert;
class EventCategoryController extends Controller
{
    protected $model = '';
    protected $path  = 'cmss';
    protected $route = 'cmss';

    public function __construct()
    {
        /* $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy'); */
        $this->model = CMS::class;
        $this->middleware('image-sanitize');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EventCategoryDatatable $datatable)
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
            'type'                => 'required|string|in:categories,products',
            'start_at'            => 'required|string',
            'title_en'            => 'required|string',
            'expire_at'           => 'required|string',
            'slug'                => 'required|string',
            'meta_tag_en'         => 'sometimes|nullable|string',
            'meta_keyword_en'     => 'sometimes|nullable|string',
            'meta_description_en' => 'sometimes|nullable|string',
            'menuTitle_en'        => 'sometimes|nullable|string',
            'content_en'          => 'sometimes|nullable|string',
            'categories.*'        => 'sometimes|nullable|numeric',
            'image'               => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:c_m_s_s',
        ],[],[
            'type'                => trans('admin.type'),
            'start_at'            => trans('admin.start_at'),
            'expire_at'           => trans('admin.expire_at'),
            'title_en'            => trans('admin.title'),
            'slug'                => trans('admin.slug'),
            'meta_tag_en'         => trans('admin.meta_tag'),
            'meta_keyword_en'     => trans('admin.meta_keyword'),
            'meta_description_en' => trans('admin.meta_description'),
            'menuTitle_en'        => trans('admin.menuTitle'),
            'content_en'          => trans('admin.content'),
            'categories.*'        => trans('admin.categories'),
        ]);
        $data['slug'] = \Str::slug($request['slug']);
        $img = '';
        if(!empty($request['image'])) {
            $img =  upload($request['image'], $this->path);
        }
        $create = $this->model::create([
            'type'             => $data['type'],
            'start_at'         => $data['start_at'],
            'title'            => $data['title_en'],
            'expire_at'        => $data['expire_at'],
            'slug'             => \Str::slug($data['slug']),
            'meta_tag'         => $data['meta_tag_en'],
            'meta_keyword'     => $data['meta_keyword_en'],
            'meta_description' => $data['meta_description_en'],
            'menuTitle'        => $data['menuTitle_en'],
            'content'          => $data['content_en'],
            'image'            => $img,
        ]);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            (empty($request['title_'.$localeCode]))?:$create->setTranslation('title', $localeCode, $request['title_'.$localeCode])->save();
            (empty($request['menuTitle_'.$localeCode]))?:$create->setTranslation('menuTitle', $localeCode, $request['menuTitle_'.$localeCode])->save();
            (empty($request['content_'.$localeCode]))?:$create->setTranslation('content', $localeCode, $request['content_'.$localeCode])->save();
            (empty($request['meta_tag_'.$localeCode]))?:$create->setTranslation('meta_tag', $localeCode, $request['meta_tag_'.$localeCode])->save();
            (empty($request['meta_description_'.$localeCode]))?:$create->setTranslation('meta_description', $localeCode, $request['meta_description_'.$localeCode])->save();
            (empty($request['meta_keyword_'.$localeCode]))?:$create->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_'.$localeCode])->save();

        };
        if($create->type == 'categories') {
            $create->categories()->attach($data['categories']);
        }
        Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route($this->route.'.index');
    }


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
            'type'                => 'required|string|in:categories,products',
            'start_at'            => 'required|string',
            'title_en'            => 'required|string',
            'expire_at'           => 'required|string',
            'slug'                => 'required|string',
            'meta_tag_en'         => 'sometimes|nullable|string',
            'meta_keyword_en'     => 'sometimes|nullable|string',
            'meta_description_en' => 'sometimes|nullable|string',
            'menuTitle_en'        => 'sometimes|nullable|string',
            'content_en'          => 'sometimes|nullable|string',
            'categories.*'        => 'sometimes|nullable|numeric',
            'image'               => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000|unique:c_m_s_s,image,'.$id,
        ],[],[
            'type'                => trans('admin.type'),
            'start_at'            => trans('admin.start_at'),
            'expire_at'           => trans('admin.expire_at'),
            'title_en'            => trans('admin.title'),
            'slug'                => trans('admin.slug'),
            'meta_tag_en'         => trans('admin.meta_tag'),
            'meta_keyword_en'     => trans('admin.meta_keyword'),
            'meta_description_en' => trans('admin.meta_description'),
            'menuTitle_en'        => trans('admin.menuTitle'),
            'content_en'          => trans('admin.content'),
            'categories.*'        => trans('admin.categories'),
        ]);
        $data['slug'] = \Str::slug($request['slug']);
        $img = '';
        if(!empty($request['image'])) {
            $image = CMS::find($id)->image;
            \Storage::delete($image);
            $img =  upload($request['image'], $this->path);
        }else {
            $img = CMS::find($id)->image;
        }
        $create =  $this->model::where('id', $id)->update([
            'type'             => $data['type'],
            'start_at'         => $data['start_at'],
            'expire_at'        => $data['expire_at'],
            'slug'             => \Str::slug($data['slug']),
            'image'            => $img,
        ]);
        $cms = CMS::find($id);

        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            (empty($request['title_'.$localeCode]))?:$cms->setTranslation('title', $localeCode, $request['title_'.$localeCode])->save();
            (empty($request['menuTitle_'.$localeCode]))?:$cms->setTranslation('menuTitle', $localeCode, $request['menuTitle_'.$localeCode])->save();
            (empty($request['content_'.$localeCode]))?:$cms->setTranslation('content', $localeCode, $request['content_'.$localeCode])->save();
            (empty($request['meta_tag_'.$localeCode]))?:$cms->setTranslation('meta_tag', $localeCode, $request['meta_tag_'.$localeCode])->save();
            (empty($request['meta_description_'.$localeCode]))?:$cms->setTranslation('meta_description', $localeCode, $request['meta_description_'.$localeCode])->save();
            (empty($request['meta_keyword_'.$localeCode]))?:$cms->setTranslation('meta_keyword', $localeCode, $request['meta_keyword_'.$localeCode])->save();
        };
        if($cms->type == 'categories') {
            $cms->categories()->sync($data['categories']);
        }
        Alert::success(trans('admin.saved'), trans('admin.success_record'));
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


    public function create_products($id) {
        $cms = CMS::findOrfail($id);
        return view('Admin.cmss.create_products', ['row' => $cms, 'title' => trans('admin.create')]);
    }
}
