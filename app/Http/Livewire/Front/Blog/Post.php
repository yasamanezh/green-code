<?php

namespace App\Http\Livewire\Front\Blog;

use App\Jobs\DefaultNotification;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\SiteOption;
use App\Models\User;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithPagination;

class Post extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $post;
    public $oneLevelBlogs;
    public $readyToLoad = false;
    public function isReady()
    {
        $this->readyToLoad = true;
    }
    public function mount($post){
        $post=\App\FrontModels\Post::where('slug',$post)->first();

        $url=Request::url();
        $link=URL::to('/');
        $keys=explode(',',$post->meta_keyword);
        if($post->meta_title){
            $title=$post->meta_title;
        }else{
            $title=$post->title;
        }
        if($post->meta_description){
            $description=$post->meta_description;
        }else{
            $description=$post->description;
        }


        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keys);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'post');
        OpenGraph::addProperty('locale', 'fa-ir');
        OpenGraph::addImage(['url' =>$link.'/storage/'.$post->thumbnail, 'size' => 300]);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('post');
        JsonLd::addImage(['url' =>$link.'/storage/'.$post->thumbnail, 'size' => 300]);

        if($post){
            $this->post=$post;
        }else{
            abort(404);
        }

        $this->oneLevelBlogs=Blog::where('status',1)->where('parent',0)->orWhere('parent',NULL)->get();
    }
    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

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
        $NewPosts=$this->readyToLoad ? \App\Models\Post::orderBy('id','DESC')->where('status',1)->take(8)->get() :[];
        $comments=$this->readyToLoad ?Comment::where('post_id',$this->post->id)->where('status',1)->paginate(10) :[];
        $options=SiteOption::first();
        return view('livewire.front.blog.post',compact('NewPosts','options','comments'))->layout('layouts.front');
    }
}
