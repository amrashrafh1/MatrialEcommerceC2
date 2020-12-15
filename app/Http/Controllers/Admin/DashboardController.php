<?php

namespace App\Http\Controllers\Admin;

use App\Charts\OnlineUsers;
use App\Charts\ProfitsChart;
use App\Charts\RevenuesChart;
use App\Http\Controllers\Controller;
use App\Sold;
use App\User;
use App\Order;
use DB;
class DashboardController extends Controller
{
    public function index()
    {
        /* chart class (users Chart) */
        $labels = ['7 days ago', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', 'Yesterday', 'Today'];
        $chart = new OnlineUsers;
        $chart->labels(array_reverse($labels));
        $chart->dataset('Users', 'line', users_charts(7))->color('#9F51B0')->backgroundColor('rgba(233, 30, 99, 0.1)');

        /* chart class (profits Chart) */
        $profit_today   = Sold::whereDate('created_at',today())->value(DB::raw('SUM((sale_price * sold - purchase_price * sold)  - coupon)'));
        $revenues_today = Sold::whereDate('created_at',today())->value(DB::raw('SUM((sale_price * sold)  - coupon)'));
        $total_orders   = Order::count();
        $total_revenues = Sold::value(DB::raw('SUM((sale_price * sold)  - coupon)'));

        $labels = ['7 days ago', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', 'Yesterday', 'Today'];
        $profits = new ProfitsChart;
        $profits->labels(array_reverse($labels));
        $profits->dataset('Profits', 'line',
        [$profit_today,
         profit_calc(1), profit_calc(2), profit_calc(3), profit_calc(4), profit_calc(4), profit_calc(5),profit_calc(6)]
        )->color('#26c6da')->backgroundColor('rgba(38, 198, 218, .1)');

        /* chart class (profits Chart) */
        $total_profits = Sold::value(DB::raw('SUM((sale_price * sold - purchase_price * sold)  - coupon)'));

        $labels = ['7 days ago', '6 days ago', '5 days ago', '4 days ago', '3 days ago', '2 days ago', 'Yesterday', 'Today'];
        $revenues = new RevenuesChart;
        $revenues->labels(array_reverse($labels));
        $revenues->dataset('Revenues', 'line',
        [$revenues_today
        , revenue_calc(1), revenue_calc(2), revenue_calc(3), revenue_calc(4), revenue_calc(4), revenue_calc(5),revenue_calc(6)]
        )->color('#ff9800')->backgroundColor('rgba(255, 152, 0, .1)');


        /*  Sales Chart  */
        $salesToday     = Sold::whereDate('created_at', today())->sum('sold');
        $salesYesterday = sales_calc(1);
        $sales          = [$salesToday
            , $salesYesterday, sales_calc(2), sales_calc(3), sales_calc(4), sales_calc(4), sales_calc(5), sales_calc(6)];


        /* Used Space */
        $disk_total_space = disk_total_space('/');
        $disk_free_space  = disk_free_space('/');

        // to get an updated date on the daily sales chart
        $sold = Sold::latest()->first();

        // get sales increase rate
        $admins = User::whereRoleIs(['superadministrator', 'administrator'])
        ->where('id', '!=', auth()->user()->id)->paginate(10);


        $onlineUsersToday = User::whereDate('last_login_at', today())->count();
        $salesIncrease = getPercentageChange(($salesYesterday)?$salesYesterday:1, $salesToday);

            return view('Admin.dashboard', ['chart' => $chart, 'disk_total_space' => $disk_total_space,
                'disk_free_space'  => $disk_free_space,  'sales'          => $sales,         'profits' => $profits, 'revenues' => $revenues
              , 'sold'             => $sold,             'salesIncrease'  => $salesIncrease, 'admins'  => $admins,
                'onlineUsersToday' => $onlineUsersToday, 'revenues_today' => $revenues_today,
                'total_revenues' => $total_revenues, 'total_orders' => $total_orders]);
    }
}
