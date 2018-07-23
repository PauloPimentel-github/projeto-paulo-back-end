<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Event;
use App\Models\GoogleMaps;

class GoogleMapsController extends Controller
{

    private $maps;

    public function __construct()
    {
        $this->maps = new GoogleMaps;
    }

    public function maps($customer_id)
    {
        //$this->maps->setAddress('Guarulhos', 'São Paulo');
        $addressCustomer = Customer::find($customer_id);
        $eventLocal = Event::find($customer_id);

        $data = array();
        $data['customer_address'] = $addressCustomer['customer_address'];
        $this->maps->setAddress($addressCustomer['customer_address']);

        $data['customer_lat'] = $this->maps->getLatLng()->lat;
        $data['customer_lng'] = $this->maps->getLatLng()->lng;
        //$this->maps->getAddress();
        //$this->maps->getLatLng()->lat
        return $data;
    }

    public function getCustomerAdrress()
    {
        $address = Customer::join('events', 'events.customer_id', '=', 'customers.customer_id')
        ->select('customers.customer_address', 'events.event_local')
        ->where('customers.customer_id', '=', $customer_id)
        ->get();
    }
}
