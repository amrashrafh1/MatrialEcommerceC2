<?php

namespace App\Http\Controllers\Admin;

use App\Events\notificationEvent;
use App\Http\Controllers\Controller;
use App\Notifications\NotificationSent;
use App\Notifications\ProductNotifications;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Charts\OnlineUsers;
class DashboardController extends Controller
{
    public function index () {
        /* chart class */
        $labels = ['7 days ago','6 days ago','5 days ago','4 days ago','3 days ago','2 days ago', 'Yesterday', 'Today'];
        $chart = new OnlineUsers;
        $chart->labels(array_reverse($labels));
        $chart->dataset('Users', 'line', users_charts(7))->color('#9F51B0')->backgroundColor('rgba(233, 30, 99, 0.1)');

        // Get the latest EUR/USD rate
        //$rate = \Swap::latest('EUR/USD');
// 1.129
       // $rate->getValue();

// 2016-08-26
     //  $rate->getDate()->format('Y-m-d');

// Get the EUR/USD rate yesterday
       // $rate = \Swap::historical('EUR/USD', \Carbon\Carbon::yesterday());
      // dd($rate);
;
       // dd($currentWeatherInGirona);
        return view('Admin.dashboard',['chart' => $chart]);
    }
}
