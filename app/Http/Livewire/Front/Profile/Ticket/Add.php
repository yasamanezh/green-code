<?php

namespace App\Http\Livewire\Front\Profile\Ticket;

use App\Jobs\DefaultNotification;
use App\Models\Notification;
use App\Models\SiteOption;
use App\Models\Ticket;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use Livewire\WithFileUploads;

class Add extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $file;

    protected $rules=[
        'ticket.title'=>'required|string|min:2',
        'ticket.description'=>'required|string|min:2',
        'file'=>'nullable||image|max:200|mimes:jpg,png,jpeg,gif',
        'ticket.part'=>'required|string',
    ];

    public function mount()
    {
        SEOMeta::setTitle(' افزودن تیکت');
        $this->ticket=new Ticket();
    }
    public function uploadImage()
    {
        $directory = "photos/tickets";
        $name = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ($directory.'/'.$name);
    }


    public function saveInfo(){
        $this->validate();
        $this->ticket->user_id=auth()->user()->id;
        if($this->file){
            $this->ticket->file=$this->uploadImage();
        }
        $this->ticket->status='user';
        $this->ticket->save();

        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            DefaultNotification::dispatch($admin, 'ticket');
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'order',
                'link' => $this->bank->id
            ]);
        }
        redirect(route('UserComment'));

    }
    public function render()
    {
        return view('livewire.front.profile.ticket.add')->layout('layouts.front');
    }
}
