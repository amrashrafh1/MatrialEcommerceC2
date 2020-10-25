<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Tradmark;
class Brands extends Component
{
    public function render()
    {
        $brands = Tradmark::select('name', 'logo', 'slug')->inRandomOrder()->take(25)->get();
        return view('livewire.brands', ['brands' => $brands]);
    }
}
