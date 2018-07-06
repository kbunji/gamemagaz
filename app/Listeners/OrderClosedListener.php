<?php

namespace App\Listeners;

use App\Events\OrderClosedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderClosedListener
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
     * @param  OrderClosedEvent  $event
     * @return void
     */
    public function handle(OrderClosedEvent $event)
    {
        //
    }
}
