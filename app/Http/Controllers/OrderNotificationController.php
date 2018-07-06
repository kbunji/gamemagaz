<?php

namespace App\Http\Controllers;

use App\OrderNotification;
use Illuminate\Http\Request;

class OrderNotificationController extends Controller
{
    use MainData;
    const TITLE_CODE = 6;

    public function all()
    {
        $data = $this->getData();
        $data['notifications'] = OrderNotification::all();
        return view('notification.manager')->with($data);
    }

    public function add()
    {
        $data = $this->getData();
        return view('notification.add')->with($data);
    }

    protected function checkStoreRequest($request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);
    }

    public function store(Request $request)
    {
        $this->checkStoreRequest($request);
        OrderNotification::addEmail($request);
        return redirect()->route('notification.manager');
    }

    public function delete($notificationId)
    {
        OrderNotification::destroy($notificationId);
        return redirect()->route('notification.manager');
    }

    protected function getTitleCode()
    {
        return self::TITLE_CODE;
    }
}
