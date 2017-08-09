<?php

namespace App\Listeners\Users\Registered;

use App\Events\Users\UserIsRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use App\Notifications\TelegramNotificationRegistered;

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
     * @param  UserIsRegistered  $event
     * @return void
     */
    public function handle(UserIsRegistered $event)
    {
        \Notification::send($event, new TelegramNotificationRegistered());
    }
}
