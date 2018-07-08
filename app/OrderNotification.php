<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderNotification extends Model
{
    protected $guarded = ['id'];

    public static function addEmail($email)
    {
        $notification = new OrderNotification();
        $notification->email = $email;
        return $notification->save();
    }
}
