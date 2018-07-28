<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Person;
use App\Phones;
use App\Order;
use App\OrderItem;

class ApiController extends Controller
{


    public function getPerson()
    {
    	$personDb = Person::with('phone')->get();

	    return json_encode($personDb);
    }   

    public function getOrders()
    {
    	$orderDb = Order::with('orderItem')->get();

	    return json_encode($orderDb);
    }

}