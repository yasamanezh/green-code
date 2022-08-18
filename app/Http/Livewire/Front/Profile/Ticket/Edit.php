<?php

namespace App\Http\Livewire\Front\Profile\Ticket;

use App\Jobs\DefaultNotification;
use App\Models\Answer;
use App\Models\Notification;
use App\Models\Ticket;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;
use Livewire\WithFileUploads;
use function view;

class Edit extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $description,$file;

    public function uploadImage()
    {
        $directory = "photos/tickets";
        $name = $this->file->getClientOriginalName();
        $this->file->storeAs($directory, $name);
        return ($directory.'/'.$name);
    }


    public function saveInfo(){

        $this->validate([
            'description'=>'required|string|min:2',
            'file'=>'nullable||image|max:200|mimes:jpg,png,jpeg,gif',
        ]);
        $answer=new Answer();
        $answer->user_id=auth()->user()->id;
        $answer->answer=$this->description;
        $answer->ticket_id=$this->ticket->id;
        if($this->file){
            $answer->file=$this->uploadImage();
        }
        $answer->save();
        $ticket=$this->ticket;
        $ticket->status='user';
        $ticket->update();
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

    public function mount($edit)
    {
        SEOMeta::setTitle('مشاهده تیکت');
        $this->ticket=Ticket::findOrFail($edit);

    }
    public function render()
    {
        return view('livewire.front.profile.ticket.edit')->layout('layouts.front');
    }
}
