<?php

namespace App\Http\Livewire\Sellers;

use Livewire\Component;
use App\Charts\SellerSalesChart;

class SalesCharts extends Component
{
    public $period;
    public $profits;
public function mount() {

    if(session()->get('period') !== null) {

        $this->period = session()->get('period');

    }else {
            $this->period = 'days';
        }
    if(session()->get('profits') !== null){
        $this->profits = session()->get('profits');

    }else {
        $this->profits = 'days';
    }

}

    public function render()
    {

        return view('livewire.sellers.sales-charts', ['chart'=> $this->Charts(), 'reveune' =>$this->Revenue_Charts()]);
    }


public function Revenue_Charts() {
    if($this->profits === 'days') {
        $labels = ['7 days ago','6 days ago','5 days ago','4 days ago','3 days ago','2 days ago', 'Yesterday', 'Today'];
        $reveune = new SellerSalesChart;
        $reveune->labels(array_reverse($labels));
        $reveune->dataset('Renvenue', 'bar', revenue_chart(8, $this->profits))->color('#0059bd')->backgroundColor('#0063d138');
        $reveune->dataset('Profit', 'bar', profit_chart(8, $this->profits))->color('#0059bd')->backgroundColor('rgb(87, 170, 93,.6)');
        $reveune->dataset('cost', 'bar', cost_chart(8, $this->profits))->color('#0059bd')->backgroundColor('rgb(220, 60, 69,.6)');
        return  $reveune;

} elseif($this->profits === 'months') {

    $labels = [\Carbon\Carbon::now()->subMonth(12)->format('F'),\Carbon\Carbon::now()->subMonth(11)->format('F'),\Carbon\Carbon::now()->subMonth(10)->format('F'),\Carbon\Carbon::now()->subMonth(9)->format('F'),\Carbon\Carbon::now()->subMonth(8)->format('F'),\Carbon\Carbon::now()->subMonth(7)->format('F')
    ,\Carbon\Carbon::now()->subMonth(6)->format('F'),\Carbon\Carbon::now()->subMonth(5)->format('F'),\Carbon\Carbon::now()->subMonth(4)->format('F')
    ,\Carbon\Carbon::now()->subMonth(3)->format('F'),\Carbon\Carbon::now()->subMonth(2)->format('F'), \Carbon\Carbon::now()->subMonth(1)->format('F'), \Carbon\Carbon::now()->format('M')];
    $reveune = new SellerSalesChart;
    $reveune->labels(array_reverse($labels));
    $reveune->dataset('Renvenue', 'bar', revenue_chart(12, $this->profits))->color('#0059bd')->backgroundColor('#0063d138');
    $reveune->dataset('Profit', 'bar', profit_chart(12, $this->profits))->color('#0059bd')->backgroundColor('rgb(87, 170, 93,.6)');
    $reveune->dataset('cost', 'bar', cost_chart(12, $this->profits))->color('#0059bd')->backgroundColor('rgb(220, 60, 69,.6)');
    return  $reveune;

}else {
    $labels = [
    \Carbon\Carbon::now()->subYear(12)->format('Y'),\Carbon\Carbon::now()->subYear(11)->format('Y'),
    \Carbon\Carbon::now()->subYear(10)->format('Y'),\Carbon\Carbon::now()->subYear(9)->format('Y'),
    \Carbon\Carbon::now()->subYear(8)->format('Y'),\Carbon\Carbon::now()->subYear(7)->format('Y'),
    \Carbon\Carbon::now()->subYear(6)->format('Y'),\Carbon\Carbon::now()->subYear(5)->format('Y'),
    \Carbon\Carbon::now()->subYear(4)->format('Y'),\Carbon\Carbon::now()->subYear(3)->format('Y'),
    \Carbon\Carbon::now()->subYear(2)->format('Y'), \Carbon\Carbon::now()->subYear(1)->format('Y'), \Carbon\Carbon::now()->format('Y')];
    $reveune = new SellerSalesChart;
    $reveune->labels(array_reverse($labels));
    $reveune->dataset('Renvenue', 'bar', revenue_chart(12, $this->profits))->color('#0059bd')->backgroundColor('#0063d138');
    $reveune->dataset('Profit', 'bar', profit_chart(12, $this->profits))->color('#0059bd')->backgroundColor('rgb(87, 170, 93,.6)');
    $reveune->dataset('cost', 'bar', cost_chart(12, $this->profits))->color('#0059bd')->backgroundColor('rgb(220, 60, 69,.6)');
    return  $reveune;

}
}
    public function Charts() {
        if($this->period === 'days') {

            $labels = ['7 days ago','6 days ago','5 days ago','4 days ago','3 days ago','2 days ago', 'Yesterday', 'Today'];
            $chart = new SellerSalesChart;
            $chart->labels(array_reverse($labels));
            $chart->dataset('Sales', 'line', seller_sales_charts(8, $this->period))->color('#0059bd')->backgroundColor('#0063d138');
            return  $chart;

        } elseif($this->period === 'months') {
            $labels = [\Carbon\Carbon::now()->subMonth(12)->format('F'),\Carbon\Carbon::now()->subMonth(11)->format('F'),\Carbon\Carbon::now()->subMonth(10)->format('F'),\Carbon\Carbon::now()->subMonth(9)->format('F'),\Carbon\Carbon::now()->subMonth(8)->format('F'),\Carbon\Carbon::now()->subMonth(7)->format('F')
            ,\Carbon\Carbon::now()->subMonth(6)->format('F'),\Carbon\Carbon::now()->subMonth(5)->format('F'),\Carbon\Carbon::now()->subMonth(4)->format('F')
            ,\Carbon\Carbon::now()->subMonth(3)->format('F'),\Carbon\Carbon::now()->subMonth(2)->format('F'), \Carbon\Carbon::now()->subMonth(1)->format('F'), \Carbon\Carbon::now()->format('M')];
            $chart = new SellerSalesChart;
            $chart->labels($labels);
            $chart->dataset('Sales', 'line', seller_sales_charts(12, $this->period))->color('#0059bd')->backgroundColor('#0063d138');
            return  $chart;

        } else {
            $labels = [
            \Carbon\Carbon::now()->subYear(12)->format('Y'),\Carbon\Carbon::now()->subYear(11)->format('Y'),
            \Carbon\Carbon::now()->subYear(10)->format('Y'),\Carbon\Carbon::now()->subYear(9)->format('Y'),
            \Carbon\Carbon::now()->subYear(8)->format('Y'),\Carbon\Carbon::now()->subYear(7)->format('Y'),
            \Carbon\Carbon::now()->subYear(6)->format('Y'),\Carbon\Carbon::now()->subYear(5)->format('Y'),
            \Carbon\Carbon::now()->subYear(4)->format('Y'),\Carbon\Carbon::now()->subYear(3)->format('Y'),
            \Carbon\Carbon::now()->subYear(2)->format('Y'), \Carbon\Carbon::now()->subYear(1)->format('Y'), \Carbon\Carbon::now()->format('Y')];
            $chart = new SellerSalesChart;
            $chart->labels(array_reverse($labels));
            $chart->dataset('Sales', 'line', seller_sales_charts(12, $this->period))
            ->color('#0059bd')->backgroundColor('#0063d138');
            return  $chart;
        }
    }

    public function updatedPeriod() {
        if(in_array($this->period, ['years','months','days'])) {
        session()->forget('period');
        session()->put('period', $this->period);
        return redirect()->route('seller_dashboard');
        }
    }
    public function updatedProfits() {
        if(in_array($this->profits, ['years','months','days'])) {
        session()->forget('profits');
        session()->put('profits', $this->profits);
        return redirect()->route('seller_dashboard');
        }
    }
}
