<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Setting;
class BlogsController extends Controller
{
    public function index() {
        $blogs = Post::paginate(15);
        $setting             = Setting::latest('id')->first();

        SEOTools::setTitle('Blogs');
        SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
        SEOTools::opengraph()->setUrl(route('blogs'));
        SEOTools::setCanonical(route('blogs'));
        SEOTools::opengraph()->addProperty('type', 'site');
        SEOTools::twitter()->setSite($setting?$setting->twitter:'');
        SEOTools::jsonLd()->addImage($setting?\Storage::url($setting->image):'');

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
        $blog_tags = \Spatie\Tags\Tag::where('slug->'.\LaravelLocalization::setLocale(),$slug)
        ->where('type', 'posts')->first();
        if($blog_tags) {
            $setting             = Setting::latest('id')->first();

            SEOTools::setTitle($blog_tags->name);
            SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
            SEOTools::opengraph()->setUrl(route('blogs'));
            SEOTools::setCanonical(route('blogs'));
            SEOTools::opengraph()->addProperty('type', 'site');
            SEOTools::twitter()->setSite($setting?$setting->twitter:'');
            SEOTools::jsonLd()->addImage($setting?\Storage::url($setting->image):'');
            return view('FrontEnd.blog_tags', ['tags' => $blog_tags]);
        } else {
            return redirect()->route('home');
        }

    }
}
