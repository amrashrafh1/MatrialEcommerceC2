<?php

namespace App\Http\Middleware;

use Closure;

class StoreSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->get('store') &&
            !$request->getSession()->get('store')) {

            $store      = auth()->user()->stores->first();
            if ($store) {
                $request->getSession()->put([
                    'store' => $store->id,
                ]);
            }
        } elseif ($request->get('store')) {

            $store      = auth()->user()->stores->where('slug', $request->get('store'))->first();
            if ($store) {
                $request->getSession()->put([
                    'store' => $store->id,
                ]);
            }
        }

        return $next($request);
    }
}
