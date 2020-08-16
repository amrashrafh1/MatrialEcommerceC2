<?php

namespace App\Http\Livewire\FrontEnd\Profile;

use Livewire\Component;

class MyFollowed extends Component
{
    public function render()
    {
        $followed = auth()->user()->followee()->paginate(20);
        return view('livewire.front-end.profile.my-followed', ['followed' => $followed]);
    }
}
