<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';


    protected $primaryKey = 'order_id';

    public function orderItem()
    {
        return $this->hasMany('App\OrderItem','order_id','order_id');
    }
}
