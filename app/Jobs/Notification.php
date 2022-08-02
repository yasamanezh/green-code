<?php

namespace App\Jobs;


use App\Models\Email;
use App\Models\Payamak;
use App\Models\SiteOption;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Trez\RayganSms\Facades\RayganSms;

class Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct()
    {
        $siteOption=SiteOption::first();
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

    /**
     * Execute the job.
     *
     * @return void
     */
    public function expire($data){
    $timeExpire = explode('/', $data->date_send);
    $dateExpired = Verta::getGregorian($timeExpire[0], $timeExpire[1], $timeExpire[2]);
    $now = now();
    $expired = verta("$dateExpired[0]-$dateExpired[1]-$dateExpired[2] $data->time_send");
    if (date_timestamp_get($expired) < date_timestamp_get($now)) {
        return true;
    }

}

    public function handle()
    {
        //send emails
        $emails=Email::where('status',0)->get();
        foreach ($emails as $email){

            if ($this->expire($email)) {
                $users=$email->user_ids;
                $userAray=explode(',',$users);
                foreach ($userAray as $user){
                    $mail=User::where('id',$user)->pluck('email')->first();
                    if($mail){
                        $emailAddress=$mail;
                        Mail::to($emailAddress)->send(new \App\Mail\SendMail($email));
                    }
                }
                $email->update([
                    'status'=>1
                ]);
            }
        }
        // send sms
        $payamaks=Payamak::where('status',0)->get();
        foreach ($payamaks as $payamak){

            if ($this->expire($payamak)) {
                $usersPayamak=$payamak->user_ids;
                $userArayusersPayamak=explode(',',$usersPayamak);
                foreach ($userArayusersPayamak as $userpayam){
                    $sms=User::where('id',$userpayam)->pluck('phone')->first();
                    if($sms){
                        $smsPhone=$sms;
                        $phoneMessage=$payamak->content;
                        RayganSms::sendMessage($smsPhone,$phoneMessage );
                    }
                }
                $payamak->update([
                    'status'=>1
                ]);
            }
        }

    }
}
