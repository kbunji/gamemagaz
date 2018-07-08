<?php

namespace App\Http\Controllers;

use App\Events\OrderClosedEvent;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function manager($productId)
    {
        $userId = Auth::id();
        $order = Order::getUserActiveOrder($userId);
        if ($order) {
            return $this->addOrderDetails($productId, $order);
        }
        return $this->createOrder($productId);
    }

    protected function addOrderDetails($productId, $order)
    {
        $data['products'] = Product::getLastProducts();
        $data['prod'] = Product::find($productId);
        $data['order'] = $order;
        return view('order.continue', $data);
    }

    protected function createOrder($productId)
    {
        $data['products'] = Product::getLastProducts();
        $data['prod'] = Product::find($productId);
        return view('order.create', $data);
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|string',
            'productId' => 'required|integer',
            'quantity' => 'required|integer'
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        $data = $request->all();
        $userId = Auth::id();
        $order = Order::createOrder($data, $userId);
        OrderDetail::createOrderDetails($data, $order);
        return redirect()->route('web.index');
    }

    protected function checkAddRequest($request)
    {
        $this->validate($request, [
            'orderId' => 'required|integer',
            'productId' => 'required|integer',
            'quantity' => 'required|integer'
        ]);
    }

    public function add(Request $request)
    {
        $this->checkAddRequest($request);
        $data = $request->all();
        OrderDetail::addOrderDetails($data);
        return redirect()->route('web.index');
    }

    public function my()
    {
        $data = array();
        $userId = Auth::id();
        $orderActive = Order::getUserActiveOrder($userId);
        if ($orderActive) {
            $data['orderActive'] = $orderActive;
            $data['orderDetails'] = OrderDetail::getOrderDetails($orderActive->id);
        }
        return view('order.my', $data);
    }

    public function close($orderId)
    {
        Order::closeActiveOrder($orderId);
        event(new OrderClosedEvent($orderId));
        return view('order.my');
    }

    public function all()
    {
        $data['adminOrders'] = Order::getOrdersForAdmin();
        return view('order.all', $data);
    }

    public function details($orderId)
    {
        $data['orderDetails'] = OrderDetail::getOrderDetails($orderId);
        return view('order.details', $data);
    }
}
