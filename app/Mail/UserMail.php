<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $username;
    public $time;
    public $token;

    public function __construct($mailData)
    {
        $this->username = $mailData['username'];
        $this->time = $mailData['time'];
        $this->token = $mailData['token'];
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), '科学五行八字')
            ->subject('激活账号—科学五行八字')
            ->view('api.activityMail')
            ->with([
                'username' => $this->username,
                'time' => $this->time,
                'token' => $this->token,
                'url' => $_SERVER['SERVER_NAME']
            ]);
    }
}
