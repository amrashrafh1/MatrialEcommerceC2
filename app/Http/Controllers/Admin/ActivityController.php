<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\ActivitiesDatatable;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['permission:read-activities']);
    }
    public function index(ActivitiesDatatable $datatable)
    {
        return $datatable->render('Admin.activities.index', ['title' =>trans('admin.activities_table')]);
    }

    public function show($id)
    {
        $row = Activity::findOrfail($id);
        return view('Admin.activities.show', ['row' => $row,'title' =>trans('admin.activities_table')]);
    }
}
