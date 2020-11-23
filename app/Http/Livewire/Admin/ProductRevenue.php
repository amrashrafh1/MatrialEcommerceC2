<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Sold;
use App\Product;
use Carbon\Carbon;
class ProductRevenue extends Component
{
    use WithPagination;

    public $sort = 'days';

    public function render()
    {
        $products_revenue = '';
        if($this->sort == 'days') {
            $products_revenue = Sold::whereDate('created_at', '>=',today()->subDays(7))
            ->groupBy('product_id')
                ->selectRaw('SUM((sale_price * sold)  - coupon) as revenue,SUM(sold) as purchases, product_id')
                ->with('product')->orderBy('revenue', 'desc')->take(10)->get();

        }elseif($this->sort == 'months') {

            $products_revenue = Sold::whereMonth('created_at', '>=',\Carbon\Carbon::now()->month)
            ->groupBy('product_id')
                ->selectRaw('SUM((sale_price * sold)  - coupon) as revenue,SUM(sold) as purchases, product_id')
                ->with('product')->orderBy('revenue', 'desc')->take(10)->get();

        } else {
            $products_revenue = Sold::whereYear('created_at','>=', \Carbon\Carbon::now()->year)
            ->groupBy('product_id')
                ->selectRaw('SUM((sale_price * sold)  - coupon) as revenue,SUM(sold) as purchases, product_id')
                ->with('product')->orderBy('revenue', 'desc')->take(10)->get();
            }

            return view('livewire.admin.product-revenue', ['products_revenue' => $products_revenue]);
    }


    public function hydrate()
    {
        app()->setLocale(session('locale'));
    }
}
