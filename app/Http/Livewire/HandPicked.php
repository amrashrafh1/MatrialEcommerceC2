<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
class HandPicked extends Component
{
    public function render()
    {
        $handpicked = Product::where('visible', 'visible')
        ->select('id','slug','name','sale_price')
        ->inRandomOrder()->take(36)->get();

        return view('livewire.hand-picked', ['handpicked' => $handpicked]);
    }
}
