<?php

namespace App\Http\Livewire\Front\Module;


use App\Models\Post;
use Livewire\Component;

class Blog extends Component
{

    public function render()
    {
        $posts=Post::orderBy('id','DESC')->get();
        return view('livewire.front.module.blog',compact('posts'));
    }
}
