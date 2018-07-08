<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $guarded = ['id'];
    const ORDER_ADMIN_STATUS = 2;
    const ORDER_CLIENT_STATUS = 1;

    public static function getOrdersForAdmin()
    {
        $orders = DB::table('orders')
            ->where('active', self::ORDER_ADMIN_STATUS)
            ->orderBy('updated_at', 'desc')
            ->get();
        return $orders;
    }

    public static function getUserActiveOrder($userId)
    {
        $order = DB::table('orders')
            ->where('user_id', $userId)
            ->where('active', self::ORDER_CLIENT_STATUS)
            ->orderBy('created_at', 'desc')
            ->first();
        return $order;
    }

    public static function closeActiveOrder($orderId)
    {
        $userId = Auth::id();
        $order = DB::table('orders')
            ->where('id', $orderId)
            ->where('user_id', $userId)
            ->update([
                'active' => self::ORDER_ADMIN_STATUS,
                'updated_at' => \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString()
            ]);
        return $order;
    }

    public static function createOrder($data, $userId)
    {
        $order = new Order();
        $order->name = $data['name'];
        $order->email = $data['email'];
        $order->active = static::ORDER_CLIENT_STATUS;
        $order->comments = $data['comments'];
        $order->user_id = $userId;
        $order->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        $order->save();
        return $order;
    }
}
