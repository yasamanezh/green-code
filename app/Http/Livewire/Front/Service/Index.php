<?php

namespace App\Http\Livewire\Front\Service;


use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        $this->options=SiteOption::first();
        $keys=explode(',',$this->options->meta_keyword);
        $url=Request::url();
        $link=URL::to('/');
        $img=$link.'/storage/'. $this->options->logo;
        $title= $this->options->meta_title;
        SEOTools::setTitle('خدمات ما');
        SEOTools::setDescription($this->options->meta_description);
        SEOTools::opengraph()->setUrl($url);
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage($img);
        SEOMeta::addKeyword($keys);
    }

    public function render()
    {
        return view('livewire.front.service.index')->layout('layouts.front');
    }
}
