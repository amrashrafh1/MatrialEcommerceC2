<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Team;
use App\Service;
class AboutUsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $teams    = Team::get();
        $services = Service::get();
        return view('FrontEnd.about_us',['teams' => $teams, 'services' => $services]);
    }
}
