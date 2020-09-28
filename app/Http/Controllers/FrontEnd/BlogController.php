<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function __invoke($slug) {

        $blog = Post::where('slug', $slug)->first();

        if($blog) {
            $previous = Post::where('id', '<', $blog->id)->orderBy('id','desc')->first();

            // get next blog id
            $next = Post::where('id', '>', $blog->id)->orderBy('id')->first();

            return view('FrontEnd.blog', ['blog' => $blog, 'previous'=>$previous,'next' => $next]);
        }

        return redirect()->route('home');
    }
}
