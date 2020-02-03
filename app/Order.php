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

    public function orderProducts()
    {
        return $this->belongsTo(Product::class,'product_id');
    }


    public function orderUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
