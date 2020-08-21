<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
use App\Events\cartEvent;

class ComparePage extends Component
{

    public function render()
    {
        if(session()->get('compare') !== null) {
            $compare = Product::whereIn('id', session()->get('compare'))->get();
        } else {
            $compare = collect();
        }
        return view('livewire.compare-page', ['compare' => $compare]);
    }

    public function removeCompare($id) {
        if(session()->get('compare') !== null) {
            if(in_array($id, session()->get('compare'))) {
                session()->forget('compare.' .array_search($id, session()->get('compare')));
                //event(new cartEvent(trans('user.removed_successfuly')));
            }
        }
    }

    public function addCart($id) {

        $product = Product::find($id);
        if($product) {
            \Cart::add($product,1);
            $this->emit('cartAdded');
        }
    }
}
