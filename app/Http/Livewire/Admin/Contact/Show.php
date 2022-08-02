<?php

namespace App\Http\Livewire\Admin\Contact;

use App\Models\Contact;
use Livewire\Component;

class Show extends Component
{
    public $contact;

    public function mount($show)
    {
        $this->contact=Contact::where('id',$show)->first();

    }
    public function render()
    {
        return view('livewire.admin.contact.show');
    }
}
