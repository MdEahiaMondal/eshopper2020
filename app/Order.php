<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function orderDetails()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
