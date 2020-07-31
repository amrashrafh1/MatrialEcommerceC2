<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelLocalization;
trait LangApi
{
    protected function checkLang($locale) {
        if (in_array($locale, array_keys(config('laravellocalization.supportedLocales')))) {
            LaravelLocalization::setLocale($locale);
        }
    }
}
