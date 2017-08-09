<?php

namespace App\Listeners\Users\Login;

use App\Events\Users\UserLoggedIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use App\Notifications\TelegramNotificationLogin;

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
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle(UserLoggedIn $event)
    {
        \Notification::send($event, new TelegramNotificationLogin());
    }
}
