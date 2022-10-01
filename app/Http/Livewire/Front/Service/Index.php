<?php

namespace App\Http\Livewire\Front\Service;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.front.service.index')->layout('layouts.front');
    }
}
