<?php

namespace App\Http\Livewire\Front\Blog;

use App\Models\Blog;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\URL;
use Livewire\Component;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public  $blog;

    public $readyToLoad = false;
    public function isReady()
    {
        $this->readyToLoad = true;
    }


    public function mount($category)
    {
        $blog=Blog::where('slug',$category)->first();
        $options=SiteOption::first();
        $url= \Illuminate\Support\Facades\Request::url();
        $link=URL::to('/');
        $keys=explode(',',$blog->meta_keyword);
        if($blog->meta_title){
            $title=$blog->meta_title;
        }else{
            $title=$blog->title;
        }
        $description=$blog->meta_description;
        $img=$link.'/storage/'. $options->logo;


        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keys);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl($url);
        OpenGraph::addProperty('type', 'blog');
        OpenGraph::addProperty('locale', 'fa-ir');
        OpenGraph::addImage(['url' =>$img, 'size' => 300]);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType('blog');
        JsonLd::addImage(['url' =>$img, 'size' => 300]);




        if($blog){
            $this->blog=$blog;
        }else{
            abort(404);
        }

    }
    public function render()
    {
        $Posts=$this->readyToLoad ? $this->blog->posts()->where('status',1)->paginate(12) :[];
        $options=SiteOption::first();
        if($this->blog){
            return view('livewire.front.blog.category',compact('Posts','options'))->layout('layouts.front');

        }else{
            abort(404);
        }

    }
}
