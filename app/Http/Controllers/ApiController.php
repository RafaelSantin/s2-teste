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
    	$personDb = Person::all();

	    return json_encode($personDb);
    }

}