<?php

namespace App\Http\Livewire\Front\Contact;

use App\Models\Contact as ContactModels;
use Livewire\Component;

class Index extends Component
{
    public ContactModels $contact;
    public $success=false;
    public function mount(){
        $this->contact=new ContactModels();
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
