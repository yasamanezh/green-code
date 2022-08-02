<?php

namespace App\Http\Livewire\admin\layouts;

use App\Models\SiteOption;
use Livewire\Component;

class Sidbar extends Component
{
    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.admin.layouts.sidbar',compact('options'));
    }
}
