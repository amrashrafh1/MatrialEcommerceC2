<?php

namespace App\Http\Livewire\FrontEnd\Profile;

use Livewire\Component;
use Livewire\WithPagination;
use App\Coupon;
class Coupons extends Component
{
    use WithPagination;
    public function render()
    {
        $coupons = Coupon::where('rules','specific_user')->orWhere('rules', 'all_users')
        ->where('expires_at', '>=',\Carbon\Carbon::now())->where('user_id', auth()->user()->id)
        ->paginate(20);
        return view('livewire.front-end.profile.coupons', ['coupons' => $coupons]);
    }
}
