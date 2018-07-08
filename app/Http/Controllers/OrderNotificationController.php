<?php

namespace App\Http\Controllers;

use App\OrderNotification;
use Illuminate\Http\Request;

class OrderNotificationController extends MainDataController
{
    const TITLE_CODE = 6;

    public function all()
    {
        $data = $this->getData();
        $data['notifications'] = OrderNotification::all();
        return view('notification.manager', $data);
    }

    public function add()
    {
        $data = $this->getData();
        return view('notification.add', $data);
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
