<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Product;
class HandPicked extends Component
{
    public function render()
    {
        $handpicked = Product::where('visible', 'visible')->where('approved', 1)
        ->select('id','slug','name','sale_price','image')
        ->inRandomOrder()->take(36)->get();

        return view('livewire.hand-picked', ['handpicked' => $handpicked]);
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
