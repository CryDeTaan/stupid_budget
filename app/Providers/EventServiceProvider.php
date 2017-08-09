<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Categories\CategoryDeleted' => [
            'App\Listeners\Categories\DeleteSubcategories',
        ],
        'App\Events\Users\UserRegistered' => [
            'App\Listeners\Users\Register\SendConfirmationEmail',
            'App\Listeners\Users\Register\SendTelegramNotification',
        ],

        'App\Events\Users\UserIsRegistered' => [
            'App\Listeners\Users\Registered\SendTelegramNotification',
        ],

        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\Users\Login\SendTelegramNotification',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
