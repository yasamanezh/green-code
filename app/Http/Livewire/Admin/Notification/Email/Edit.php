<?php

namespace App\Http\Livewire\Admin\Notification\Email;

use App\Jobs\Notification;
use App\Models\Email;
use App\Models\Log;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Edit extends Component
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


    public function mount($edit)
    {
        $this->email=Email::find($edit);

        $time=explode(':',$this->email->time_send);
        $this->showUserIds=explode(',',$this->email->user_ids);
        $this->email->time=$time[0];
        $this->email->minute=$time[1];
        $this->expire=$this->email->date_send.'-'.$time[0].':'.$time[1];
    }

    protected $rules = [

        'email.subject' => 'required|string|min:2|max:255',
        'email.content' => 'required|string|min:2|max:255',
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
            $this->email->update([
                'date_send' => $date_time[0],
                'time_send' => $date_time[1],
                'content' => $this->email->content,
                'subject' => $this->email->subject,
                'user_ids' => $comma_separated,
            ]);

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'ویرایش ایمیل' . '-' . auth()->user()->name,
                'actionType' => 'ویرایش'
            ]);
            $msg = 'ایمیل با موفقیت ایجاد شد.';
            return redirect(route('EmailNotification'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }
    public function expire($data)
    {
        $timeExpire = explode('/', $data->date_send);
        $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
        $now = now();
        $expired = verta("$dateExpired[0]-$dateExpired[1]-$dateExpired[2] $data->time_send");

        if (date_timestamp_get($expired) < date_timestamp_get($now)) {
            return true;
        } else {
            return false;
        }
    }
    public function render()
    {

        $users = User::get();

        return view('livewire.admin.notification.email.edit',compact('users'));
    }
}
