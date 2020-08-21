<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompareHeader extends Component
{
    public $Foo;

    protected  $listeners = ['compareAdded' => 'compareEvent'];

    public function compareEvent()
    {
        $this->Foo = 'updated';
    }

    public function render()
    {
        return view('livewire.compare-header');
    }

}
