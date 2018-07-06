<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Helper\Table;

class OrderDetail extends Model
{
    protected $guarded = ['id'];

    public static function countOrderProducts($userId)
    {
        $count = 0;
        $order = Order::getUserActiveOrder();
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

    public static function createOrderDetails($request, $order = null)
    {
        $orderDetail = new OrderDetail();
        $orderDetail->quantity = $request->get('quantity');
        $orderDetail->product_id = $request->get('productId');
        $orderDetail->order_id = $order->id;
        $orderDetail->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $orderDetail->save();
    }

    public static function addOrderDetails($request)
    {
        $orderDetail = new OrderDetail();
        $orderDetail->quantity = $request->get('quantity');
        $orderDetail->product_id = $request->get('productId');
        $orderDetail->order_id = $request->get('orderId');
        $orderDetail->created_at = \Carbon\Carbon::now('Asia/Almaty')->toDateTimeString();
        return $orderDetail->save();
    }
}
