<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use MainData;
    const TITLE_CODE = 5;

    public function manager($productId)
    {
        $order = Order::getUserActiveOrder();
        if ($order) {
            return $this->addOrderDetails($productId, $order);
        }
        return $this->createOrder($productId);
    }

    protected function addOrderDetails($productId, $order)
    {
        $data = $this->getData();
        $data['products'] = Product::getLastProducts();
        $data['prod'] = Product::getProduct($productId);
        $data['order'] = $order;
        return view('order.continue')->with($data);
    }

    protected function createOrder($productId)
    {
        $data = $this->getData();
        $data['products'] = Product::getLastProducts();
        $data['prod'] = Product::getProduct($productId);
        return view('order.create')->with($data);
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'productId' => 'required',
            'quantity' => 'required'
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        $order = Order::createOrder($request);
        OrderDetail::createOrderDetails($request, $order);
        return redirect()->route('web.index');
    }

    protected function checkAddRequest($request)
    {
        $this->validate($request, [
            'orderId' => 'required',
            'productId' => 'required',
            'quantity' => 'required'
        ]);
    }

    public function add(Request $request)
    {
        $this->checkAddRequest($request);
        OrderDetail::addOrderDetails($request);
        return redirect()->route('web.index');
    }

    public function my()
    {
        $data = $this->getData();
        $orderActive = Order::getUserActiveOrder();
        if ($orderActive) {
            $data['orderActive'] = $orderActive;
            $data['orderDetails'] = OrderDetail::getOrderDetails($orderActive->id);
        }
        return view('order.my')->with($data);
    }

    public function close($orderId)
    {
        $data = $this->getData();
        Order::closeActiveOrder($orderId);
        return view('order.my')->with($data);
    }

    public function all()
    {
        $data = $this->getData();
        $data['adminOrders'] = Order::getOrdersForAdmin();
        return view('order.all')->with($data);
    }

    public function details($orderId)
    {
        $data = $this->getData();
        $data['orderDetails'] = OrderDetail::getOrderDetails($orderId);
        return view('order.details')->with($data);
    }

    protected function getTitleCode()
    {
        return self::TITLE_CODE;
    }
}
