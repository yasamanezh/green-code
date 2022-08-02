<?php

namespace App\Http\Livewire\Front\Layouts\Header;

use App\Models\Cart;
use Livewire\Component;

class Acount extends Component
{
    public function isAdmin(){
        $role=auth()->user()->role;
        if($role == 'user'){
           return false;
        }else{
            return true;
        }
    }

    public function render()
    {

        return view('livewire.front.layouts.header.acount');
    }
}
