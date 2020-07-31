<?php

namespace App\Http\Livewire\FrontEnd\Profile;

use Livewire\Component;
use Livewire\WithPagination;
use App\Order;
class Orders extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = auth()->user()->orders()->orderBy('id','desc')->paginate(20);
        return view('livewire.front-end.profile.orders', ['orders' => $orders]);
    }
}
