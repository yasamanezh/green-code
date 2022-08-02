<?php

namespace App\Http\Livewire\Front\Module;

use App\Models\Slider as SliderModels;
use Livewire\Component;

class Slider extends Component
{
    public $slider;
    public $idModule;
    public $count=0;

    public function mount($slide){
        $array=explode(',',$slide);
        $this->idModule=$array[1];
        $slideid=$array['0'];
        $this->slider=SliderModels::where('id',$slideid)->first();
        foreach($this->slider->Slides as $value)
        {
            $this->count=$this->count+1;

        }

    }

    public function render()
    {

        return view('livewire.front.module.slider');
    }
}
