<?php

namespace App\Http\Livewire\Admin\Notification\Email;

use App\Jobs\Notification;
use App\Models\Discount;
use App\Models\Email;
use App\Models\Log;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public $email;
    public $showUserIds = [];
    public $expire;
    public $SelectAll=false;

    public function UpdatedSelectAll($value)
    {
        if ($value){
            $this->showUserIds=User::get()->pluck('id')->map(fn($item)=>(string) $item)->toArray();
        }else{
            $this->showUserIds=[];
        }

    }

    public function mount()
    {
        $this->email = new Email();
    }

    protected $rules = [

        'email.subject' => 'required|string|min:2|max:255',
        'email.content' => 'required|string|min:2',
    ];

    public function updated($subject)
    {
        $this->validateOnly($subject);
    }

    public function categoryForm()
    {
        if (Gate::allows('edit_notification')) {
            $this->validate([
                'expire' => "required|date_format:Y/m/d-H:i",
            ]);
            $date_time = explode('-', $this->expire);
            $comma_separated = implode(",", $this->showUserIds);


            $this->validate();
            Email::query()->create([
                'date_send' => $date_time[0],
                'time_send' => $date_time[1],
                'content' => $this->email->content,
                'subject' => $this->email->subject,
                'user_ids' => $comma_separated,
                'status'=>0

            ]);


            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن ایمیل' . '-' . auth()->user()->name,
                'actionType' => 'ایجاد'
            ]);



            $msg = 'ایمیل با موفقیت ایجاد شد.';
            return redirect(route('EmailNotification'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function render()
    {

        $users = User::get();

        return view('livewire.admin.notification.email.add',compact('users'));
    }
}
