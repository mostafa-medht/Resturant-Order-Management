<?php

namespace App\Listeners;

use App\Mail\ChargeIngredientMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UpdateNotifyUserWithIngredientLevelListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->ingredient->quantity < ($event->ingredient->level_of_stock / 2) && !$event->ingredient->notify_with_ingredient_quantity){
            $event->ingredient->update(['notify_with_ingredient_quantity' => 1]);
        }
    }
}
