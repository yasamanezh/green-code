<?php

namespace App\Jobs;

use App\Models\SiteOption;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Trez\RayganSms\Facades\RayganSms;

class DefaultNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $user,$type;
    public function __construct($user,$type)
    {

        $siteOption=SiteOption::first();
        $this->user=$user;
        $this->type=$type;

        if($siteOption->sms_panel){
            Config::set('services.raygansms.phone_number', $siteOption->sms_panel);
        }
         if($siteOption->sms_usename){
            Config::set('services.raygansms.user_name', $siteOption->sms_usename);
        }
        if($siteOption->sms_password){
            Config::set('services.raygansms.phone_number', $siteOption->sms_password);
        }

        if($siteOption->mail_parameter){
            Config::set('mail.from.address', $siteOption->mail_parameter);
        }
        if($siteOption->mail_username){
            Config::set('mail.mailers.smtp.username', $siteOption->mail_username);
        }
        if($siteOption->mail_password){
            Config::set('mail.mailers.smtp.password', $siteOption->mail_password);
        }
        if($siteOption->mail_mailer){
            Config::set('mail.mailers.smtp.transport', $siteOption->mail_mailer);
        }else{
            Config::set('mail.mailers.smtp.transport', 'smtp');
        }
       if($siteOption->mail_host){
            Config::set('mail.mailers.smtp.host', $siteOption->mail_host);
        }else{
           Config::set('mail.mailers.smtp.host', 'smtp.mailgun.org');
       }
       if($siteOption->mail_port){
            Config::set('mail.mailers.smtp.port', $siteOption->mail_port);
        }else{
           Config::set('mail.mailers.smtp.port','587');
       }
       if($siteOption->mail_encription){
            Config::set('mail.mailers.smtp.encryption', $siteOption->mail_encription);
        }else{
           Config::set('mail.mailers.smtp.encryption','tls');
       }

    }


    public function handle()
    {
        $option=SiteOption::first();
        $URL=\Illuminate\Support\Facades\URL::to('/');

        $link=$URL;
        $type=$this->type;

        if ($type == 'comment_product'){
            $Message='ثبت دیدگاه جدید برای محصول!';
           }
        elseif ($type == 'contact'){
            $Message='شما یک پیام جدید دارید.';

           }
        elseif ($type == 'question'){
            $Message='ثبت پرسش  جدید  !';

        }
        elseif ($type == 'comment'){
            $Message='ثبت دیدگاه جدید  !';
        }
        elseif ($type == 'register'){
            $Message='کاربر گرامی ثبت نام شما در سایت موفقیت آمیز بود.';
        }
        elseif ($type == 'register_admin'){
            $Message='ثبت نام کاربر جدید.';
        }
        elseif ($type == 'question_answer'){
            $Message='پرسش شما پاسخ داده شد.';
        }
        elseif ($type == 'order'){
            $Message='با تشکر از خرید شما.سفارش شما در سامانه ثبت شد.';

        }
        elseif ($type == 'order_admin'){
            $Message='سفارش جدید در سامانه ثبت شد.';

        }
        elseif ($type == 'complate'){
            $Message='سفارش شما تحویل داده شد.';
        }
        elseif ($type == 'post'){
            $Message='سفارش شما تحویل پست داده شد.';
        }

        if($option->order_sms){
            if($this->user->phone){
                $phone=$this->user->phone;
                echo RayganSms::sendMessage($phone,$Message );
            }
        }
        if($option->order_email){
            if($this->user->email){
                Mail::to($this->user->email)->send(new \App\Mail\OrderShipped($Message,$link,$type));
            }
        }
    }
}
