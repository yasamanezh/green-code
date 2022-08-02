<?php

namespace App\Http\Livewire\Front\Layouts\Footer;

use App\Models\SiteOption;
use Livewire\Component;

class Script extends Component
{
    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.layouts.footer.script',compact('options'));
    }
}
