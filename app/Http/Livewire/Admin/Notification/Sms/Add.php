<?php

namespace App\Http\Livewire\Admin\Notification\Sms;


use App\Models\Log;
use App\Models\Payamak;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;

class Add extends Component
{
    public $payamak;
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
        $this->payamak = new Payamak();
    }

    protected $rules = [

        'payamak.content' => 'required',
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
            Payamak::query()->create([
                'date_send' => $date_time[0],
                'time_send' => $date_time[1],
                'content' => $this->payamak->content,
                'user_ids' => $comma_separated,
                'status'=>0

            ]);

            Log::create([
                'user_id' => auth()->user()->id,
                'url' => 'افزودن پیامک' . '-' . auth()->user()->name,
                'actionType' => 'ایجاد'
            ]);
            $msg = 'پیامک با موفقیت ایجاد شد.';
            return redirect(route('SmsNotification'))->with('sucsess', $msg);

        } else {
            $this->emit('toast', 'warning', 'شما اجازه ویرایش این قسمت را ندارید.');
        }


    }

    public function render()
    {

        $users = User::get();

        return view('livewire.admin.notification.sms.add',compact('users'));
    }
}
