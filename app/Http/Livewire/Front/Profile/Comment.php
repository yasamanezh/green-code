<?php

namespace App\Http\Livewire\Front\Profile;

use App\Models\Notification;
use App\Models\Question;
use App\Models\SiteOption;
use App\Models\Ticket;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Comment extends Component
{
    public function mount()
    {
        SEOMeta::setTitle('تیکت ها');
    }
    public function status($id){
        $ticket=Ticket::findOrFail($id);
        if($ticket->status == 0){
            return 'بسته شده';
        }elseif($ticket->status == 'user'){
            return 'در حال بررسی';
        }elseif ($ticket->status == 'admin'){
            return 'پاسخ داده شده';
        }else{
            return 'پیام ادمین';
        }
    }
    public function render()
    {
        $tickets=Ticket::where('user_id',auth()->user()->id)->paginate(10);
        $options=SiteOption::first();
        return view('livewire.front.profile.comment',compact('tickets','options'))->layout('layouts.front');;
    }
}
