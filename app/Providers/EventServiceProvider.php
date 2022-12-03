<?php

namespace App\Providers;

use App\Events\CheckIngredientStockAfterConsumedEvent;
use App\Events\NewOrderPlacedEvent;
use App\Listeners\SendChargeIngredientEmailListener;
use App\Listeners\UpdateIngredientStockListener;
use App\Listeners\UpdateNotifyUserWithIngredientLevelListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
            NewOrderPlacedEvent::class => [
                UpdateIngredientStockListener::class,
            ],
            CheckIngredientStockAfterConsumedEvent::class => [
                SendChargeIngredientEmailListener::class,
                UpdateNotifyUserWithIngredientLevelListener::class
            ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
