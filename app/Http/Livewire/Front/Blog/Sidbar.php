<?php

namespace App\Http\Livewire\Front\Blog;

use App\Models\Blog;
use App\Models\SiteOption;
use Livewire\Component;

class Sidbar extends Component
{
    public function hasParent($id)
    {
        $blog=Blog::where('status',1)->where('parent',$id)->first();
        if($blog){
            return true;
        }else{
            return false;
        }

    }

    public function render()
    {
        $oneLevelBlogs=Blog::where('status',1)->where('parent',0)->orWhere('parent',NULL)->get();
        $options=SiteOption::first();
        $NewPosts= \App\Models\Post::orderBy('id','DESC')->where('status',1)->take(5)->get();

        return view('livewire.front.blog.sidbar',compact('NewPosts','options','oneLevelBlogs'));
    }
}
