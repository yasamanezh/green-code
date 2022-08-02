<?php

namespace App\Http\Livewire\Front\Blog;

use App\Models\Blog;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public  $oneLevelBlogs;
    public $readyToLoad = false;
    public function isReady()
    {
        $this->readyToLoad = true;
    }
    public function mount(){
        $this->options=SiteOption::first();
        $keys=explode(',',$this->options->meta_keyword);
        $url=Request::url();
        $link=URL::to('/');
        $img=$link.'/storage/'. $this->options->logo;
        $title='وبلاگ';
        SEOTools::setTitle($title);
        SEOTools::opengraph()->setUrl($url);
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage($img);
        SEOMeta::addKeyword($keys);

        $this->oneLevelBlogs=Blog::where('status',1)->where('parent',0)->orWhere('parent',NULL)->get();

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
        $NewPosts=$this->readyToLoad ? \App\Models\Post::orderBy('id','DESC')->where('status',1)->take(5)->get() :[];
        $Posts=$this->readyToLoad ? \App\Models\Post::orderBy('id','DESC')->where('status',1)->paginate(12):[];;
        $options=SiteOption::first();
        return view('livewire.front.blog.index',compact('NewPosts','options','Posts'))->layout('layouts.front');
    }
}
