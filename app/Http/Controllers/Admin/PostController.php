<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PostDataTable;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Image;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    protected $model = '';
    protected $path = 'posts';
    protected $route = 'posts';

    public function __construct()
    {
        $this->middleware(['permission:read-' . $this->path])->only('index');
        $this->middleware(['permission:create-' . $this->path])->only('create');
        $this->middleware(['permission:update-' . $this->path])->only('edit');
        $this->middleware(['permission:delete-' . $this->path])->only('destroy');
        $this->model = Post::class;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostDataTable $datatable)
    {
        return $datatable->render('Admin.' . $this->path . '.index', ['title' => $this->path . ' Table']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.' . $this->path . '.create', ['title' => 'Create ' . $this->path]);
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
            'title_en' => 'required|string|max:100',
            'content_en' => 'required|min:3',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'commentable' => 'sometimes|nullable',
            'slug' => 'required|string|unique:posts',
            'publish_at' => 'required|string',
            'tags_en' => 'required|string',
        ], [], [
            'title_en' => trans('admin.title_en'),
            'content_en' => trans('admin.content_en'),
            'image' => trans('admin.image'),
            'commentable' => trans('admin.commentable'),
            'slug' => trans('admin.slug'),
            'publish_at' => trans('admin.publish_at'),
            'tags_en' => trans('admin.tags_en'),
        ]);

        if (!empty($data['image'])) {
            $data['image'] = upload($request['image'], $this->path, 1726, 660);

        }
        $create = $this->model::create([
            'title'       => $data['title_en'],
            'content'     => $data['content_en'],
            'image'       => $data['image'],
            'publish_at'  => \Carbon\Carbon::parse($data['publish_at']),
            'user_id'     => auth()->user()->id,
            'commentable' => (isset($data['commentable'])) ? 0 : 1,
            'slug'        => \Str::slug($data['slug']),
        ]);
        foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $create->setTranslation('title', $localeCode, $request['title_' . $localeCode])->save();
            $create->setTranslation('content', $localeCode, $request['content_' . $localeCode])->save();
        };

        if (!empty($data['tags_en'])) {
            $data_en = explode(',', $data['tags_en']);
            foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                ($localeCode == 'en') ? '' : ${'data_' . $localeCode} = explode(',', $request['tags_' . $localeCode]);
            }
            foreach ($data_en as $index => $att) {
                $create->attachTag($att, 'posts');
                $tag = \Spatie\Tags\Tag::findOrCreate($att, 'posts');
                foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    if ($localeCode != 'en') {
                        if (!empty(${'data_' . $localeCode}[$index])) {
                            $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                        }
                    }
                }
            }
        }
        Alert::success(trans('admin.added'), trans('admin.success_record'));
        return redirect()->route($this->route . '.index');
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
        return view('Admin.' . $this->path . '.show', ['title' => 'Show ' . $this->path, 'rows' => $rows]);
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
        return view('Admin.' . $this->path . '.edit', ['title' => 'Edit ' . $this->path, 'rows' => $rows]);
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
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png,gif,bmp|max:10000',
            'publish_at' => 'required',

        ], [], [
            'image' => trans('admin.image'),
            'publish_at' => trans('admin.publish_at'),
        ]);
        $titles = $this->validate(request(), [
            'title_en'    => 'required|string|max:100',
            'content_en'  => 'required|min:3',
            'slug'        => 'required|string|unique:products,slug,' . $id,
            'commentable' => 'sometimes|nullable',
            'tags_en'     => 'sometimes|nullable',
        ], [], [
            'title_en'    => trans('admin.title_en'),
            'slug'        => trans('admin.slug'),
            'content_en'  => trans('admin.content_en'),
            'commentable' => trans('admin.commentable'),
            'tags_en'     => trans('admin.tags_en'),
        ]);
        if (!empty($data['image'])) {
            $image = $this->model::find($id)->image;
            \Storage::delete($image);
            $data['image'] = upload($data['image'], $this->path, 1726, 660);

        }
        $update = $this->model::find($id);
        $this->model::where('id', $id)->update([
            'image'       => (isset($data['image'])) ? $data['image'] : $update->image,
            'publish_at'  => (isset($data['publish_at'])) ? \Carbon\Carbon::parse($data['publish_at']) : $update->publish_at,
            'slug'        => (isset($titles['slug'])) ? \Str::slug($titles['slug']) : $update->slug,
            'commentable' => (empty($titles['commentable'])) ? 0 : 1,
        ]);
        foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            (empty($request['title_' . $localeCode])) ?: $update->setTranslation('title', $localeCode, $request['title_' . $localeCode])->save();
            (empty($request['content_' . $localeCode])) ?: $update->setTranslation('content', $localeCode, $request['content_' . $localeCode])->save();
        };

        if (!empty($request['tags_en'])) {
            $data_en = explode(',', $request['tags_en']);
            foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                ($localeCode === 'en') ? '' : ${'data_' . $localeCode} = explode(',', $request['tags_' . $localeCode]);
            }
            $update->syncTagsWithType($data_en, 'posts');
            foreach ($data_en as $index => $tag) {
                $tag = \Spatie\Tags\Tag::findOrCreate($tag, 'posts');
                //dd($tag);
                foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                    if ($localeCode != 'en') {
                        if (!empty(${'data_' . $localeCode}[$index])) {
                            //dd(${'data_' . $localeCode}[$index]);
                            $tag->setTranslation('name', $localeCode, ${'data_' . $localeCode}[$index])->save();
                        }
                    }
                }
            }
            //$newsItem->syncTagsWithType('posts');
        }
        Alert::success(trans('admin.updated'), trans('admin.success_record'));
        return redirect()->route($this->route . '.index');
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
        return redirect()->route($this->route . '.index');
    }
    public function destory_all(Request $request)
    {
        if (request()->has('item') && $request->item != '') {
            if (is_array($request->item)) {
                foreach ($request->item as $d) {
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
        return redirect()->route($this->route . '.index');
    }
}
