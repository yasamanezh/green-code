<?php

namespace App\Http\Livewire\admin\layouts;

use App\Models\Notification;
use Livewire\Component;

class Header extends Component
{
    public $users,$orders,$comments,$comment_product,$questions;

    public function deleteUser()
    {
        foreach ($this->users as $user){
            if($user){
                $user->delete();
            }
        }
        redirect(route('Users'));

    }
    public function deleteOrders()
    {
        foreach ($this->orders as $order){
            if($order){
                $order->delete();
            }
        }
        redirect(route('admin.orders.index'));

    }


    public function deleteComment()
    {
        foreach ($this->comments as $comment){
            if($comment){
                $comment->delete();
            }
        }
        redirect(route('Coments'));

    }
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

    public function deleteCommentProduct()
    {
        foreach ($this->comment_product as $comment){
            if($comment){
                $comment->delete();
            }
        }
        redirect(route('ProductComment'));

    }
    public function deleteQuestion()
    {
        foreach ($this->questions as $question){
            if($question){
                $question->delete();
            }
        }
        redirect(route('Questions'));

    }

    public function render()
    {
        $messages=Notification::where('type','contact')->where('user_id',auth()->user()->id)->get();
        $notifications=Notification::where('type','<>','contact')->where('user_id',auth()->user()->id)->get();
        $register=Notification::where('type','register')->where('user_id',auth()->user()->id)->get();
        $this->orders=Notification::where('type','order')->where('user_id',auth()->user()->id)->get();
        $this->comments=Notification::where('type','comment')->where('user_id',auth()->user()->id)->get();
        $this->comment_product=Notification::where('type','comment_product')->where('user_id',auth()->user()->id)->get();
        $this->questions=Notification::where('type','question')->where('user_id',auth()->user()->id)->get();

        $this->users=$register;
        return view('livewire.admin.layouts.header',compact('messages','notifications','register'));
    }
}
