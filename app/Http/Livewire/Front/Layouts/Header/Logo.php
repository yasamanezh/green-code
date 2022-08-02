<?php

namespace App\Http\Livewire\Front\Layouts\Header;

use App\Models\SiteOption;
use Livewire\Component;

class Logo extends Component
{
    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.layouts.header.logo',compact('options'));
    }
}
