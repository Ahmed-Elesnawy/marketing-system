<?php

namespace App\Listeners;

use App\Events\MoneyRequestConfirmedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveMoneyFormMarkter
{
    

    /**
     * Handle the event.
     *
     * @param  MoneyRequestConfirmedEvent  $event
     * @return void
     */
    public function handle(MoneyRequestConfirmedEvent $event)
    {
        $event->markter->update([

            'commission'  => $event->markter->commission - $event->moneyNeeded,
            
        ]);
    }
}
