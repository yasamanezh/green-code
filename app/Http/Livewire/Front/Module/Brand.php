<?php

namespace App\Http\Livewire\Front\Module;

use App\Models\Manufacturer;
use Livewire\Component;

class Brand extends Component
{

    public function render()
    {
        $brands=Manufacturer::get();
        return view('livewire.front.module.brand',compact('brands'));
    }
}
