<?php

namespace App\Http\Livewire\Front\Blog;


use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Index extends Component
{
   public $options;

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
    }


    public function render()
    {

        $Posts=\App\Models\Post::orderBy('id','DESC')->where('status',1)->paginate(12);

        return view('livewire.front.blog.index',compact('Posts'))->layout('layouts.front');
    }
}
