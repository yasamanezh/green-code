<?php

namespace App\Http\Livewire\admin\Dashboard;

use App\Models\Contact;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        $contacts = Contact::orderBy('id', 'DESC')->take(10)->get();
        return view('livewire.admin.dashboard.index', compact( 'contacts'));
    }
}
