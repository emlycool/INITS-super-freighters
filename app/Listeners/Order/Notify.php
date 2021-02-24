<?php

namespace App\Listeners\Order;

use App\Mail\AdminNewOrder;
use App\Mail\OrderReceived;
use App\Events\NewOrderCompleted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notify
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
     * @param  NewOrderCompleted  $event
     * @return void
     */
    public function handle(NewOrderCompleted $event)
    {
        Mail::to($event->order->email)->send(new OrderReceived($event->order));
        Mail::to(config('system.admin_email'))->send(new AdminNewOrder($event->order));
    }
}
