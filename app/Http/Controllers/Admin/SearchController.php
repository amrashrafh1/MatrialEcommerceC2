<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class SearchController extends Controller
{

    public function __construct()
    {


    }

    public function result(Request $request) {
        $arrays = [
            'products', 'categories', 'orders', 'logs',
            'user', 'trademarks', 'malls', 'countries', 'cities',
            'companies','zones','methods','sellers','manufacturers',
            'settings','posts','languages','events','currencies'];
        $contains = \Str::contains($request['q'], $arrays);
        if($cotains) {
            $collection = collect($arrays);
            $index = $collection->search($request['q']);
            if($arrays[$index] == 'logs') {

                return redirect(aurl('/log-viewer'));

            } elseif($arrays[$index] == 'languages') {
                return redirect(url('/languages'));

            } elseif($arrays[$index] == 'currencies') {
                return redirect(aurl('/currencies'));

            } elseif($arrays[$index] == 'settings') {
                return redirect(aurl('/settings'));

            } elseif($arrays[$index] == 'events') {
                return redirect(aurl('/fullcalendar'));

            }elseif($arrays[$index] == 'sellers') {
                return redirect(aurl('/seller'));

            } elseif ($arrays[$index] == 'trademarks') {
                return redirect()->route('tradmarks.index');
            } else {
                return redirect()->route($arrays[$index].'.index');
            }
        } else {
            $searchResults = (new Search())
                ->registerModel(\App\User::class, 'name', 'last_name')
                ->registerModel(\App\Post::class, 'title', 'content')
                ->registerModel(\App\Product::class, 'name')
                ->registerModel(\App\Category::class, 'name')
                ->search($request['q']);
            return view('Admin.searchResult', ['allResult' => $searchResults]);
        }
    }
}
