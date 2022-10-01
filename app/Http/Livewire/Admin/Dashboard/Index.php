<?php

namespace App\Http\Livewire\admin\Dashboard;

use App\Models\Contact;
use App\Models\Order;
use App\Models\SiteOption;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        $contacts = Contact::orderBy('id', 'DESC')->take(10)->get();
        return view('livewire.admin.dashboard.index', compact( 'contacts'));
    }
}
