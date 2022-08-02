<?php

namespace App\Mail;

use App\Models\SiteOption;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $email;
    public $option,$URL,$message;
    public function __construct($email)
    {
        $this->email=$email;
        $this->URL=\Illuminate\Support\Facades\URL::to('/');
        $this->option=SiteOption::first();
        $this->message=$email->content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_mail')->subject($this->email->subject);
    }
}
