<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PostDataTable;
use Image;
use RealRashid\SweetAlert\Facades\Alert;
class PostController extends Controller
{
    protected $model = '';
    protected $path  = 'posts';
    protected $route = 'posts';

    public function __construct()
    {
        $this->middleware(['permission:read-'.$this->path])->only('index');
        $this->middleware(['permission:create-'.$this->path])->only('create');
        $this->middleware(['permission:update-'.$this->path])->only('edit');
        $this->middleware(['permission:delete-'.$this->path])->only('destroy');
        $this->model = Post::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostDataTable $datatable)
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
            'title_en'    => 'required|string|max:100',
            'content_en'  => 'required|min:3',
            'image'       => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'commentable' => 'required',
            'slug'        => 'required|string|unique:posts',
            'publish_at'  => 'required|string',
        ],[],[
            'title_en'    => trans('admin.title_en'),
            'content_en'  => trans('admin.content_en'),
            'image'       => trans('admin.image'),
            'commentable' => trans('admin.commentable'),
            'slug'        => trans('admin.slug'),
            'publish_at'  => trans('admin.publish_at')
        ]);


        if(!empty($data['image'])) {
            $filenamewithextension = $data['image']->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $data['image']->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.uniqid().'.'.$extension;

            \Storage::put('public/'.$this->path.'/'. $filenametostore, fopen($data['image'], 'r+'));
           // \Storage::put('public/'.$this->path.'/thumbnail/'. $filenametostore, fopen($data['image'], 'r+'));

            //Resize image here
          //  $thumbnailpath = public_path('storage/'.$this->path.'/thumbnail/'.$filenametostore);
          //  $image = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
          //    $constraint->aspectRatio();
           // });
          //  $image->save($thumbnailpath);
            $data['image'] = 'public/'.$this->path.'/'.$filenametostore;
        }
        $create = $this->model::create([
            'title'       => $data['title_en'],
            'content'     => $data['content_en'],
            'image'       => $data['image'],
            'publish_at'  => \Carbon\Carbon::parse($data['publish_at']),
            'user_id'     => auth()->user()->id,
            'commentable' => ($data['commentable'] == NULL)?0:1,
            'slug'        => \Str::slug($data['slug']),
        ]);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $create->setTranslation('title', $localeCode, $request['title_'.$localeCode])->save();
            $create->setTranslation('content', $localeCode, $request['content_'.$localeCode])->save();
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
            'image'       => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'publish_at'  => 'required'

        ],[],[
            'image'       => trans('admin.image'),
            'publish_at'  => trans('admin.publish_at')
        ]);
        $titles = $this->validate(request(), [
            'title_en'   => 'required|string|max:100',
            'content_en' => 'required|min:3',
            'slug'       => 'required|string|unique:posts',
            'commentable' => 'sometimes|nullable|numeric',
        ],[],[
            'title_en'   => trans('admin.title_en'),
            'slug'       => trans('admin.slug'),
            'content_en' => trans('admin.content_en'),
            'commentable' => trans('admin.commentable')
            ]);
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

            \Storage::put('public/'.$this->path.'/'. $filenametostore, fopen($data['image'], 'r+'));
          //  \Storage::put('public/'.$this->path.'/thumbnail/'. $filenametostore, fopen($data['image'], 'r+'));

            //Resize image here
           // $thumbnailpath = public_path('storage/'.$this->path.'/thumbnail/'.$filenametostore);
           // $image = Image::make($thumbnailpath)->resize(400, 150, function($constraint) {
            //  $constraint->aspectRatio();
           // });
            //$image->save($thumbnailpath);
            $data['image'] = 'public/'.$this->path.'/'.$filenametostore;
        }
        $this->model::where('id', $id)->update($data);
        $this->model::where('id', $id)->update([
            'slug'    => \Str::slug($data['slug']),
            'content' => $titles['content_en'],
            'title'   => $titles['title_en'],
            'commentable' => (empty($titles['commentable']))?0:1
        ]);
        $update = $this->model::find($id);
        foreach(\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $update->setTranslation('title', $localeCode, $request['title_'.$localeCode])->save();
            $update->setTranslation('content', $localeCode, $request['content_'.$localeCode])->save();
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
