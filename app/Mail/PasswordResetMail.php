<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $token;
    public $created_at;

    public function __construct($mailData)
    {
        $this->created_at = $mailData['created_at'];
        $this->token = $mailData['token'];
        $this->email = $mailData['email'];
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), '科学五行八字')
            ->subject('重置密码—科学五行八字')
            ->view('api.resetPassword')
            ->with([
                'username' => $this->created_at,
                'time' => $this->email,
                'token' => $this->token,
                'url' => $_SERVER['SERVER_NAME']
            ]);
    }
}
