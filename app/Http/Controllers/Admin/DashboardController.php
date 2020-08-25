<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OnlineUsers;
use App\Http\Controllers\Controller;
use App\Sold;
class DashboardController extends Controller
{
    public function index()
    {
        /* chart class (users Chart) */
        $labels = ['7 days ago', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', 'Yesterday', 'Today'];
        $chart = new OnlineUsers;
        $chart->labels(array_reverse($labels));
        $chart->dataset('Users', 'line', users_charts(7))->color('#9F51B0')->backgroundColor('rgba(233, 30, 99, 0.1)');


        /*  Sales Chart  */
        $salesToday     = Sold::whereDate('created_at', today())->sum('sold');
        $salesYesterday = sales_calc(1);
        $sales          = [$salesToday
            , $salesYesterday, sales_calc(2), sales_calc(3), sales_calc(4), sales_calc(4), sales_calc(5), sales_calc(6)];
        $profits = [Sold::whereDate('created_at',today())->value(\DB::raw('SUM((sale_price * sold - purchase_price * sold)  - coupon)'))
        , profit_calc(1), profit_calc(2), profit_calc(3), profit_calc(4), profit_calc(4), profit_calc(5),profit_calc(6)];


        /* Used Space */
        $disk_total_space = disk_total_space('/');
        $disk_free_space  = disk_free_space('/');

        // to get an updated date on the daily sales chart
        $sold = Sold::latest()->first();

        // get sales increase rate

        $salesIncrease = getPercentageChange(($salesYesterday)?$salesYesterday:1, $salesToday);

       return view('Admin.dashboard', ['chart' => $chart, 'disk_total_space' => $disk_total_space,
            'disk_free_space' => $disk_free_space, 'sales' => $sales,'profits' =>$profits
            ,'sold' => $sold, 'salesIncrease' => $salesIncrease]);
    }
}
