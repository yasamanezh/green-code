<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use App\Models\varify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Trez\RayganSms\Facades\RayganSms;

class Register extends Component
{
    public $data = [
        "name" => "",
        "email" => "",
        "password" => "",
        "password_confirmation" => "",
        "policy" => false
    ];

    public function handleRegister()
    {
        $this->validate([
            'data.name' => 'required|string|min:3',
            'data.phone' => 'required|digits:11|unique:users,phone',
            'data.password' => 'required|string|min:6|confirmed',
            'data.policy' => 'accepted'
        ]);
        $ip = request()->getClientIp();
        $user = new User;
        $varify = new varify;
        $user->name = $this->data['name'];
        $user->phone = $this->data['phone'];
        $user->password = Hash::make($this->data['password']);
        $user->save();
        $appname = env('APP_NAME');
        $code = rand(10000, 99999);
        /*$status =  RayganSms::sendAuthCode($this->data['phone'],"  کد تایید شما : $code
        $appname", false);*/
        $varify->receiver = $this->data['phone'];
        $varify->ip = $ip;
        $varify->massage = 'ارسال کد تایید';
        $varify->code = $code;
        $varify->count = 0;
        $varify->save();
        $id = $user->id;
        Auth::loginUsingId($id);
        return $this->redirect(route('Verify', $user->phone));
    }

    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.auth');
    }
}
