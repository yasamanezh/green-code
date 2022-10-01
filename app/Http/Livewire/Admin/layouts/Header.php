<?php

namespace App\Http\Livewire\admin\layouts;

use App\Models\Notification;
use Livewire\Component;

class Header extends Component
{
    public $users;


    public function deleteMessage()
    {
        $contacts=Notification::where('type','contact')->where('user_id',auth()->user()->id)->get();

        foreach ($contacts as $item){
            if($item){
                $item->delete();
            }
        }
        redirect(route('contacts'));

    }
    public function render()
    {
        $messages=Notification::where('type','contact')->where('user_id',auth()->user()->id)->get();

        return view('livewire.admin.layouts.header',compact('messages'));
    }
}
