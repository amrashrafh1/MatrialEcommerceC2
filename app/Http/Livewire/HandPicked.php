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
        $compare = session()->get('compare');

        return view('livewire.hand-picked', ['handpicked' => $handpicked, 'compare' => $compare]);
    }

    public function compare($id) {
        if(session()->get('compare') !== null) {
            if(!in_array($id,session()->get('compare'))) {
                $this->emit('compareAdded');
                session()->push('compare', $id);
            } else {
                return ;
            }
        } else {
            $this->emit('compareAdded');
            session()->push('compare', $id);
        }

    }
}
