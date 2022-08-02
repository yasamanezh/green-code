<?php

namespace App\Http\Livewire\Front\Module;

use App\Jobs\DefaultNotification;
use App\Models\Contact as ContactModels;
use App\Models\Notification;
use App\Models\SiteOption;
use App\Models\User;
use Livewire\Component;

class Contact extends Component
{
    public $captcha;
    public ContactModels $contact;

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function mount(){
        $this->contact=new ContactModels();
    }
    protected $rules = [
        'contact.name' => 'required|string|min:2',
        'contact.email' => 'required|email',
        'contact.content' => 'required|string|min:2',
        'captcha' => 'required|captcha',
    ];

    public function saveInfo()
    {
        $this->validate();
        $this->contact->save();


        $admins=User::where('role','admin')->get();
        foreach($admins as $admin){
            $type='contact';
            DefaultNotification::dispatch($admin,$type);
            Notification::create([
                'user_id' => $admin->id,
                'type'=>'contact',
                'link'=>$this->contact->id
            ]);
        }

        $this->contact->name='';
        $this->contact->email='';
        $this->contact->content='';
        $this->captcha='';
        $this->emit('toast', 'success','پیام شما دریافت شد و در اولین فرصت پاسخ داده خواهد شد.');


    }
    public function render()
    {
        $options=SiteOption::first();
        return view('livewire.front.module.contact',compact('options'));
    }
}
