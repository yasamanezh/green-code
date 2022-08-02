<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\Notification;
use Livewire\Component;

class Sidbar extends Component
{
    public $questions;

    public function mount()
    {
        $this->questions=Notification::where('type','question_answer')->where('user_id',auth()->user()->id)->get();


    }
    public function render()
    {
        dd($this->questions);

        return view('livewire.front.profile.sidbar')->layout('layouts.front');
    }
}
