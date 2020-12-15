<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;

class ProductAccessories extends Component
{
    public $product;
    public $total       = 0;
    public $accessories = [];
    public $prices      = [];

    public function mount($product) {
        $this->product = $product;
    }

    public function render()
    {
        $this->total = 0;

        foreach ($this->accessories as $tota) {
            if (isset($this->prices[$tota])) {
                $product = Product::where('id', $tota)->first();
                if ($product) {
                    $this->total += $this->prices[$tota];
                }
            }
        }

        $accessories = $this->product->accessories()->IsApproved()->with('attributes','discount')->get();

        return view('livewire.product-accessories', ['accesso' => $accessories]);
    }
}
