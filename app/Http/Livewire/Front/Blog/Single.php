<?php

namespace App\Http\Livewire\Front\Blog;


use App\FrontModels\Post;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Single extends Component
{
    public Post $post;
    public $isSavComment=false;
    public $comment;


    public function mount($id){
        $post=\App\FrontModels\Post::where('slug',$id)->first();

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
        OpenGraph::addImage(['url' =>$link.'/storage/'.$post->image, 'size' => 300]);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('post');
        JsonLd::addImage(['url' =>$link.'/storage/'.$post->image, 'size' => 300]);

        if($post){
            $this->post=$post;
        }else{
            abort(404);
        }

    }
    public function saveComment()
    {
        $post=$this->post;
        $this->validate([
            'comment'=>'required',
        ]);
        $comment=new \App\Models\Comment();
        $comment->post_id=$post->id;
        $comment->status=0;
        $comment->content=$this->comment;
        $comment->save();
        $this->isSavComment=true;

        $this->captcha='';

    }

    public function render()
    {
        $latests=Post::orderBy('id','DESC')->take(4)->get();
        $comments=\App\Models\Comment::where('post_id',$this->post->id)->where('status',1)->paginate(10);

        return view('livewire.front.blog.single',compact('latests','comments'))->layout('layouts.front');
    }
}
