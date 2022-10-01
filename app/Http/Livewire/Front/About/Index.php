<?php

namespace App\Http\Livewire\Front\About;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.front.about.index')->layout('layouts.front');
    }
}
