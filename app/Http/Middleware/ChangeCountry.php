<?php

namespace App\Http\Middleware;

use App\Country;
use Closure;
use Illuminate\Http\Request;

class ChangeCountry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       // session()->forget('country');

        if (!$request->get('country') &&
            !$request->getSession()->get('country')) {

            $clientIP     = $request->getClientIp();
            $localCountry = geoip($clientIP)->getAttribute('country');
            $country      = \DB::table('countries')->where('country_name', 'LIKE', '%' . $localCountry . '%')->first();
            if ($country) {
                $request->getSession()->put([
                    'country' => $country->id,
                ]);
            }
        } elseif ($request->get('country')) {

            $country = \DB::table('countries')->where('country_name', 'LIKE', '%' . $request->get('country') . '%')->first();
            if ($country) {

                $request->getSession()->put([
                    'country' => $country->id,
                ]);
            }
        }

        return $next($request);
    }
}
