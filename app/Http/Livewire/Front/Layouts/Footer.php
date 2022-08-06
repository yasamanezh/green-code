<?php

namespace App\Http\Livewire\Front\Layouts;

use App\Models\SiteOption;
use Livewire\Component;


class Footer extends Component
{


    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.layouts.footer',compact('options'));
    }
}
