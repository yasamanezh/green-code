<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\Notification;
use App\Models\Question;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Comment extends Component
{
    public function mount()
    {
        SEOMeta::setTitle('دیدگاه ها');
    }
    public function render()
    {
        $questions=Question::where('user_id',auth()->user()->id)->paginate(10);
        $options=SiteOption::first();
        return view('livewire.front.profile.comment',compact('questions','options'))->layout('layouts.front');;
    }
}
