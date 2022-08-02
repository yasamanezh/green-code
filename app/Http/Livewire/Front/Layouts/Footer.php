<?php

namespace App\Http\Livewire\Front\Layouts;

use App\Models\NewsLetter;
use App\Models\SiteOption;
use App\Models\Social;
use Livewire\Component;
use App\Models\Footer as FooterModels;

class Footer extends Component
{


    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.layouts.footer',compact('options'));
    }
}
