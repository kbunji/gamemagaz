<?php

namespace App\Events;

use App\Mail\NewOrder;
use App\OrderDetail;
use App\OrderNotification;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderClosedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param $orderId
     */
    public function __construct($orderId)
    {
        $emailClient = User::find(Auth::id())->email;
        $data = [
            'emailClient' => $emailClient,
            'orderId' => $orderId,
            'orderDetails' => OrderDetail::getOrderDetails($orderId)
        ];
        $emails = OrderNotification::all();
        Mail::to($emails)->send(new NewOrder($data));
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
