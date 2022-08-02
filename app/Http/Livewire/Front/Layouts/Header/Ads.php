<?php

namespace App\Http\Livewire\Front\Layouts\Header;

use App\Models\SiteOption;
use Livewire\Component;

class Ads extends Component
{
    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.layouts.header.ads',compact('options'));
    }
}
