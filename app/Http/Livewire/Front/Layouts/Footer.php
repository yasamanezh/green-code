<?php

namespace App\Http\Livewire\Front\Layouts;

use App\Models\NewsLetter;
use Livewire\Component;

class Footer extends Component
{
    public $email;
    public $success=false;

    public function saveEmail()
    {
        $this->validate([
            'email'=>'required|email'
        ]);
        $news_letters=new NewsLetter();
        $news_letters->email=$this->email;
        $news_letters->save();
        $this->email='';
        $this->success=true;

    }
    public function render()
    {
        return view('livewire.front.layouts.footer');
    }
}
