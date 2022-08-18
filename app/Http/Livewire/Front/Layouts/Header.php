<?php

namespace App\Http\Livewire\Front\Layouts;



use Livewire\Component;


class Header extends Component
{
   public $showChat=false;

    public function shoeChatBox()
    {
        $this->showChat=true;
    }
   public function hideChatBox()
    {
        $this->showChat=false;
    }

    public function render()
    {

        return view('livewire.front.layouts.header');
    }
}
