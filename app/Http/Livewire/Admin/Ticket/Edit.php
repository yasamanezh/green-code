<?php

namespace App\Http\Livewire\Admin\Ticket;

use App\Models\Answer;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;

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

        redirect(route('AdminTickets'));

    }

    public function mount($edit)
    {
        $this->ticket=Ticket::findOrFail($edit);

    }

    public function render()
    {

        return view('livewire.admin.ticket.edit');
    }
}
