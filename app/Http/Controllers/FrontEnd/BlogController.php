<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Artesaos\SEOTools\Facades\SEOTools;
use App\Setting;
class BlogController extends Controller
{
    public function __invoke($slug) {

        $blog = Post::where('slug', $slug)->first();

        if($blog) {
            $previous = Post::where('id', '<', $blog->id)->orderBy('id','desc')->first();

            // get next blog id
            $next = Post::where('id', '>', $blog->id)->orderBy('id')->first();

            $setting             = Setting::latest('id')->first();

            SEOTools::setTitle($blog->title);
            SEOTools::setDescription($setting?$setting->meta_description:config('app.name'));
            SEOTools::opengraph()->setUrl(route('blog'));
            SEOTools::setCanonical(route('blog'));
            SEOTools::opengraph()->addProperty('type', 'site');
            SEOTools::twitter()->setSite($setting?$setting->twitter:'');
            SEOTools::jsonLd()->addImage(\Storage::url($blog->image));
            return view('FrontEnd.blog', ['blog' => $blog, 'previous'=>$previous,'next' => $next]);
        }

        return redirect()->route('home');
    }
}
