<?php

namespace App\Http\Livewire\Front\Blog;

use App\Jobs\DefaultNotification;
use App\Models\Notification;
use App\Models\User;
use Livewire\Component;

class Comment extends Component
{
    public $post;
    public $captcha,$comment;
    public $isSavComment=false;
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function mount($id)
    {
       $this->post=\App\Models\Post::findOrFail($id);

    }

    public function saveComment()
    {
        $post=$this->post;
        $this->validate([
            'comment'=>'required',
            'captcha' => 'required|captcha',
        ]);
        $comment=new \App\Models\Comment();
        $comment->post_id=$post->id;
        $comment->status=0;
        $comment->content=$this->comment;
        $comment->save();
        $this->isSavComment=true;

        $admins=User::where('role','admin')->get();
        foreach($admins as $admin){
            DefaultNotification::dispatch($admin,'comment');
            Notification::create([
                'user_id' => $admin->id,
                'type'=>'comment',
                'link'=>$comment->id
            ]);
        }

        $this->comment='';
        $this->captcha='';

    }
    public function render()
    {
        $comments=\App\Models\Comment::where('post_id',$this->post->id)->where('status',1)->paginate(10);

        return view('livewire.front.blog.comment',compact('comments'));
    }
}
