<?php

namespace App\Mail;

use App\Models\SiteOption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $message;
    public $option,$URL,$link,$type,$userName;
    public function __construct($message,$link,$type)
    {
        $this->URL=\Illuminate\Support\Facades\URL::to('/');
        $this->message=$message;

        $this->link=$link;
        $this->type=$type;
        $this->option=SiteOption::first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->type =='register'){
            $subject='ثبت تام در سایت';
        }elseif($this->type =='post'){
            $subject=' ارسال سفارش';
        }elseif($this->type =='complate'){
            $subject='تحویل مرسوله';
        }
        elseif($this->type =='order'){
            $subject ='ثبت سفارش جدید';
        }elseif($this->type =='comment'){
            $subject ='ثبت دیدگاه جدید';
        }elseif($this->type =='comment_product'){
            $subject ='ثبت نظر جدید برای محصول';
        }elseif($this->type =='question'){
            $subject ='ثبت پرسش جدید برای محصول';
        }elseif($this->type =='contact'){
            $subject ='پیام جدید';
        }elseif($this->type =='question_answer'){
            $subject ='پاسخ پرسش';
        }elseif($this->type =='register_admin'){
            $subject ='ثبت نام کاربر جدید';
        }elseif($this->type =='order_admin'){
            $subject ='ثبت نام سفارش جدید';
        }

        return $this->markdown('emails.orders.shipped')->subject($subject);
    }
}
