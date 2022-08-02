<?php

namespace App\Http\Livewire\Auth;

use App\Models\varify;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Livewire\Component;

class VerifyPhoneNumber extends Component
{
    public $date;
    public $num1;
    public $num2;
    public $num3;
    public $num4;
    public $num5;
    public $code;
    public $distance;
    public $varify;
    public $clientIP;
    public $countip;
    public $phone;

    public function mount()
    {
        $this->clientIP = request()->ip();
        $this->phone = Request()->phone;
        $this->varify = varify::orderBy('id', 'DESC')->where('receiver', $this->phone)->first();
    }

    protected $rules = [
        'num1' => 'required|digits:1',
        'num2' => 'required|digits:1',
        'num3' => 'required|digits:1',
        'num4' => 'required|digits:1',
        'num5' => 'required|digits:1',
    ];

    public function CheckCode()
    {
        if ($this->distance > 0) {
            if ($this->validate()) {
                $this->code = $this->num1 . $this->num2 . $this->num3 . $this->num4 . $this->num5;
                if ($this->varify->count <= 3) {
                    if ($this->code == $this->varify->code) {
                        return $this->redirect('/');
                    } else {
                        $this->varify->count++;
                        $this->varify->update();
                        $this->num1 = '';
                        $this->num2 = '';
                        $this->num3 = '';
                        $this->num4 = '';
                        $this->num5 = '';
                        $this->emit('toast', 'warning', 'کد وارد شده اشتباه بود.');
                    }
                } else {
                    $this->emit('toast', 'error', 'تعداد تلاش های شما بیشتر از حد مجاز بود');
                }
            } else {
                $this->emit('toast', 'error', 'کد 5 رقمی بدرستی وارد نشده است.');
            }
        } elseif ($this->distance <= 0) {
            $this->countip = varify::where('created_at', '>', Carbon::now()->subHours(1)->toDateTimeString())
                ->where('ip', $this->clientIP)->count();
            if ($this->countip <= 30) {
                $varify = new varify;
                $appname = env('APP_NAME');
                $code = rand(10000, 99999);
                /*$status =  RayganSms::sendAuthCode($this->data['phone'],"  کد تایید شما : $code
                $appname", false);*/
                $varify->receiver = $this->phone;
                $varify->ip = $this->clientIP;
                $varify->massage = 'ارسال کد تایید';
                $varify->code = $code;
                $varify->count = 0;
                $varify->save();
                return $this->redirect(route('Verify', $this->phone));
            }
            $this->emit('toast', 'error', 'تعداد دفعات ارسال پیامک برای شما در یک ساعت بیشتر از حد مجاز بوده لطفا دقایقی دیگر تلاش کنید');
        }
    }

    public function render()
    {
        $this->date = $this->varify->created_at->timestamp + 120;
        $this->distance = $this->date - now()->timestamp;
        return view('livewire.auth.verify-phone-number')->layout('layouts.auth');
    }
}
