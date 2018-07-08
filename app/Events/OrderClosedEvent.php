<?php

namespace App\Events;

use App\OrderDetail;
use App\OrderNotification;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
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
        Mail::to($emails)->send(new \App\Mail\newOrder($data));
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
