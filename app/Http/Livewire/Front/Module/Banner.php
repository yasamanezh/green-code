<?php

namespace App\Http\Livewire\Front\Module;

use Livewire\Component;

class Banner extends Component
{
    public $banners;

    public function mount($banner){
        $this->banners=\App\Models\Banner::where('id',$banner)->first();

    }
    public function render()
    {
        return view('livewire.front.module.banner');
    }
}
