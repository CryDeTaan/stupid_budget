<?php

namespace App\Listeners\Users;

use App\Events\Users\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserRegisteredTelegramNotification;

class SendTelegramNotification implements ShouldQueue
{
    use Notifiable;

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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {



        \Notification::send($event, new UserRegisteredTelegramNotification());

        var_dump($event->user['name'].' created an account on Stupid Budget.');
    }
}
