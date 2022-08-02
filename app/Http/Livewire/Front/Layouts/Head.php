<?php

namespace App\Http\Livewire\Front\Layouts;

use App\Models\SiteOption;
use Livewire\Component;

class Head extends Component
{
    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.layouts.head',compact('options'));
    }
}
