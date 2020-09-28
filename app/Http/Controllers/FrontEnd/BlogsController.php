<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
class BlogsController extends Controller
{
    public function index() {
        $blogs = Post::paginate(15);
        return view('FrontEnd.blogs', ['blogs' => $blogs]);
    }

    public function blogs_search(Request $request) {
        $data = $this->validate(request(), [
            's' => 'required|string|min:3'
        ], [], [
            's' => trans('admin.search')
        ]);
        $blogs = Post::where('title->'.session('locale'),'LIKE', '%'.$data['s']. '%')->paginate(15);
        return view('FrontEnd.blogs', ['blogs' => $blogs]);
    }




    public function blogs_tags($slug) {
        $blog_tags = \Spatie\Tags\Tag::where('slug->'.\LaravelLocalization::setLocale(),$slug)->where('type', 'posts')->first();
        if($blog_tags) {
            return view('FrontEnd.blog_tags', ['tags' => $blog_tags]);
        } else {
            return redirect()->route('home');
        }

    }
}
