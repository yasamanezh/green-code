<?php

namespace App\Http\Livewire\Front\Contact;

use App\Models\Contact as ContactModels;
use App\Models\SiteOption;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class Index extends Component
{
    public ContactModels $contact;
    public $success=false;

    public function mount()
    {
        $this->contact=new ContactModels();
        $this->options=SiteOption::first();
        $keys=explode(',',$this->options->meta_keyword);
        $url=Request::url();
        $link=URL::to('/');
        $img=$link.'/storage/'. $this->options->logo;
        $title= $this->options->meta_title;
        SEOTools::setTitle('تماس با ما');
        SEOTools::setDescription($this->options->meta_description);
        SEOTools::opengraph()->setUrl($url);
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::opengraph()->addImage($img);
        SEOMeta::addKeyword($keys);
    }


    protected $rules = [
        'contact.name' => 'required|string|min:2',
        'contact.email' => 'required|email',
        'contact.phone' => 'required|digits:11',
        'contact.content' => 'required|string|min:2',
    ];

    public function saveInfo()
    {
        $this->validate();
        $this->contact->save();
        $this->contact->name='';
        $this->contact->email='';
        $this->contact->content='';
        $this->contact->phone='';
        $this->success=true;

    }
    public function render()
    {
        return view('livewire.front.contact.index')->layout('layouts.front');
    }
}
