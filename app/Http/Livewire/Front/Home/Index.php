<?php

namespace App\Http\Livewire\Front\Home;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.front.home.index')->layout('layouts.front');
    }
}
