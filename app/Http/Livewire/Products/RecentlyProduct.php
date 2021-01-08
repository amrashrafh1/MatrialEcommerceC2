<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use App\Product;
class RecentlyProduct extends Component
{
    public function render()
    {
        $sessions = session()->get('recently_viewed');
        if($sessions !== null) {
            $recently_viewed = Product::isApproved()->whereIn('id', $sessions)
            ->with(['ratings'=> function ($query) {
                $query->where('approved', 1);
            }, 'discount'])
            ->select('id','slug','product_type','approved', 'visible','name','image','sale_price')->take(40)->get();
        } else {
            $recently_viewed = collect();
        }

        return view('livewire.products.recently-product', ['recently_viewed' => $recently_viewed]);
    }
}
