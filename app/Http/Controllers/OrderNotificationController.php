<?php

namespace App\Http\Controllers;

use App\OrderNotification;
use Illuminate\Http\Request;

class OrderNotificationController extends Controller
{

    public function all()
    {
        $data['notifications'] = OrderNotification::all();
        return view('notification.manager', $data);
    }

    public function add()
    {
        return view('notification.add');
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'email' => 'required|unique:order_notifications'
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        $email = $request->get('email');
        OrderNotification::addEmail($email);
        return redirect()->route('notification.manager');
    }

    public function delete($notificationId)
    {
        OrderNotification::destroy($notificationId);
        return redirect()->route('notification.manager');
    }
}
