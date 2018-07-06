<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderNotification extends Model
{
    protected $guarded = ['id'];

    public static function getEmails()
    {
        $emails = DB::table('order_notifications')
            ->get()->toArray();
        return $emails;
    }

    public static function addEmail(Request $request)
    {
        $notification = new OrderNotification();
        $notification->email = $request->get('email');
        return $notification->save();
    }
}
