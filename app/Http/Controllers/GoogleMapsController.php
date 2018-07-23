<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Event;
use App\Models\GoogleMaps;

class GoogleMapsController extends Controller
{

    private $mapAddress;
    private $mapEvent;

    public function __construct()
    {
        $this->mapAddress = new GoogleMaps;
        $this->mapEvent = new GoogleMaps;
    }

    public function maps($customer_id)
    {
        //$this->maps->setAddress('Guarulhos', 'São Paulo');
        $addressCustomer = Customer::find($customer_id);
        $eventLocal = Event::find($customer_id);

        $data = array();

        $data['customer_address'] = $addressCustomer['customer_address'];
        $this->mapAddress->setAddress($addressCustomer['customer_address']);

        $data['customer_lat'] = $this->mapAddress->getLatLng()->lat;
        $data['customer_lng'] = $this->mapAddress->getLatLng()->lng;

        $data['event_local'] = $eventLocal['event_local'];
        $this->mapEvent->setAddress($data['event_local']);

        $data['event_lat'] = $this->mapEvent->getLatLng()->lat;
        $data['event_lng'] = $this->mapEvent->getLatLng()->lng;
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
