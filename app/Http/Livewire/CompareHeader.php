<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CompareHeader extends Component
{
    public $foo = 'updating';
    protected  $listeners = ['echo:private-cartupdate,cartEvent' => 'cartEvent'];

    public function render()
    {
        return view('livewire.compare-header');
    }

    public function cartEvent()
    {
        $this->Foo = 'updated';
    }
}
