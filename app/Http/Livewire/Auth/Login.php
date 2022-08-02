<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $data = [
        'email' => "",
        'password' => "",
        'remember' => false,
    ];

    public function login()
    {
        $this->validate([
            'data.phone' => 'required|digits:11',
            'data.password' => 'required|string|regex:/^[a-zA-Z0-9@$#^%&*!]+$/u',
        ]);

        if (Auth::attempt([
            'phone' => $this->data['phone'],
            'password' => $this->data['password'],
        ], $this->data['remember'])) {
            return redirect()->to('/');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}
