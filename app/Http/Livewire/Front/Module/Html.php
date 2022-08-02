<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;
use App\Models\Html as HtmlModels;

class Html extends Component
{
    public $module;
    public function mount($html){
        $this->module=HtmlModels::find($html);
    }
    public function render()
    {
        return view('livewire.front.module.html');
    }
}
