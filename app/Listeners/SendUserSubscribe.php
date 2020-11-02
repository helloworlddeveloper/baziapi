<?php

namespace App\Listeners;

use App\Events\UserSubscribe;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserSubscribe
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserSubscribe $event
     * @return void
     */
    public function handle(UserSubscribe $event)
    {
        \Log::alert('测试' . $event->user->username);
    }
}
