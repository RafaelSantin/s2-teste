<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Person;
use App\Phones;
use App\Order;
use App\OrderItem;

class UploadController extends Controller
{

    public function upload(Request $request)
    {
    	Log::debug('poee');
        Log::debug($request);
        $file = $request->file('file')[0]->getRealPath();

     	Log::debug($file);

        if (file_exists($file)) {
		    $xml = simplexml_load_file($file);

		    for ( $j = 0; $j < count( $xml ); $j++ ) {
				if(isset($xml->person[$j]) && !is_null($xml->person[$j]))
				{
					$this->savePerson($xml->person[$j]);
				}

				if(isset($xml->shiporder[$j]) && !is_null($xml->shiporder[$j]))
				{
					$this->saveOrder($xml->shiporder[$j]);
				}
			}

		    print_r($xml);
		} else {
		    exit('Falha ao abrir test.xml.');
		}
    }

    private function savePerson($person)
    {
    	$personDb = new Person;

    	$personDb->person_id = $person->personid;
    	$personDb->person_name = $person->personname;

    	$personDb->save();

    	foreach ($person->phones->phone as $key => $phone) {
    		Log::debug('aaa');
    		$phonesDb = new Phones;

    		$phonesDb->person_id = $person->personid;;
    		$phonesDb->phone_description = $phone;

    		$phonesDb->save();
    	}
    }

    private function saveOrder($order)
    {
    	$orderDb = new Order;

    	$orderDb->order_id = $order->orderid;
    	$orderDb->person_id = $order->orderperson;
		$orderDb->order_ship_name =  $order->shipto->name;
		$orderDb->order_ship_address =  $order->shipto->address;
		$orderDb->order_ship_city =  $order->shipto->city;
		$orderDb->order_ship_country =  $order->shipto->country;

    	$orderDb->save();

    	foreach ($order->items->item as $key => $it) {
    		Log::debug('aaa');
    		$orderItemDb = new OrderItem;

    		$orderItemDb->order_id = $orderDb->order_id;
            $orderItemDb->order_item_title  =   $it->title;
            $orderItemDb->order_item_note  =   $it->note;
            $orderItemDb->order_item_quantity  =   $it->quantity;
            $orderItemDb->order_item_price  =   $it->price;

    		$orderItemDb->save();
    	}
    }
}