<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\SettingsResource;
use App\Setting;
use App\Http\Controllers\Api\ApiResponse;
use App\Http\Controllers\Api\LangApi;

class SettingController extends Controller
{
    use ApiResponse,LangApi;

    public function index($locale) {

        $this->checkLang($locale);

        $Setting    = Setting::latest('id')->first();
        if($Setting) {
            return $this->sendResult('show Settings',new SettingsResource($Setting));
        }
        return $this->sendResult('Setting not found',null, 'Setting not found',false);
    }
}
