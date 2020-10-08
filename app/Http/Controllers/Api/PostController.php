<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Post;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\LangApi;

class PostController extends Controller
{
    use ApiResponse, LangApi;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        $this->checkLang($locale);

        return $this->sendResult('paginate 10 Posts',
        PostResource::collection(Post::with('comments')->paginate(10)));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($locale,$slug) {

        $this->checkLang($locale);

        $Post = Post::where('slug',$slug)->with('comments')->first();
        if($Post) {
            return $this->sendResult('show Post',new PostResource($Post));
        }
        return $this->sendResult('Post not found',null, 'Post not found',false);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
