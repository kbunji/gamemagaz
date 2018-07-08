<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetail extends Model
{
    protected $guarded = ['id'];

    public static function countOrderProducts($userId)
    {
        $count = 0;
        $order = Order::getUserActiveOrder($userId);
        if ($order) {
            $count = DB::table('order_details')
                ->where('order_id', $order->id)
                ->sum('quantity');
        }
        return $count;
    }

    public static function getOrderDetails($orderId)
    {
        $details = DB::table('order_details')
            ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
            ->where('order_id', $orderId)
            ->get();
        return $details;
    }

    public static function createOrderDetails($data, $order)
    {
        $orderDetail = new OrderDetail();
        $orderDetail->quantity = $data['quantity'];
        $orderDetail->product_id = $data['productId'];
        $orderDetail->order_id = $order->id;
        $orderDetail->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $orderDetail->save();
    }

    public static function addOrderDetails($data)
    {
        $orderDetail = new OrderDetail();
        $orderDetail->quantity = $data['quantity'];
        $orderDetail->product_id = $data['productId'];
        $orderDetail->order_id = $data['orderId'];
        $orderDetail->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $orderDetail->save();
    }
}
