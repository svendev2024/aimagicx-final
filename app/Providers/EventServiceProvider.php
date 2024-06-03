<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\SendNewUserListener;
use App\Listeners\NewPaymentListener;
use App\Listeners\AddCommissionsListener;
use App\Listeners\PayoutRequestListener;
use App\Events\PaymentProcessed;
use App\Events\PaymentReferrerBonus;
use App\Events\PayoutRequested;
use App\Models\User;
use App\Observers\UserObserver;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            SendNewUserListener::class,
        ],
        PaymentProcessed::class => [
            NewPaymentListener::class
        ],
        PayoutRequested::class => [
            PayoutRequestListener::class
        ],
        PaymentReferrerBonus::class => [
            AddCommissionsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
