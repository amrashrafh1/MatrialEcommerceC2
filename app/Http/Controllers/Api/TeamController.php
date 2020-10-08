<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TeamsResource;
use App\Team;
use App\Http\Controllers\Api\ApiResponse;
class TeamController extends Controller
{
    use ApiResponse;

    public function index() {

        return $this->sendResult('paginate 10 Teams',
        TeamsResource::collection(Team::paginate(10)));
    }


    public function show($id) {

        $Team = Team::where('id',$id)->first();
        if($Team) {
            return $this->sendResult('show Teams',new TeamsResource($Team));
        }
        return $this->sendResult('Team not found',null, 'Team not found',false);
    }
}
