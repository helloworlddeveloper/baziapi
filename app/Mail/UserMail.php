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
        return $this->from(env('MAIL_FROM_ADDRESS'), '白小飞八字命盘管理系统')
            ->subject('激活账号—白小飞八字命盘管理系统')
            ->view('api.activityMail')
            ->with([
                'username' => $this->username,
                'time' => $this->time,
                'token' => $this->token,
                'url' => $_SERVER['SERVER_NAME']
            ]);
    }
}
