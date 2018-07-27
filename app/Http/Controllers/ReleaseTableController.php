<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Event;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReleaseTableController extends Controller
{
    //recupera local do evento
    public function getEventsLocal()
    {
        $customer = Customer::join('events', 'events.customer_id', '=', 'customers.customer_id')
        ->select('events.event_id', 'events.customer_id', 'customers.customer_name', 'events.event_local',  'events.event_name', 'events.event_quant_mesas')
        ->orderBy('events.event_id', 'ASC')
        ->orderBy('customers.customer_name', 'ASC')
        ->orderBy('events.event_quant_mesas', 'ASC')
        ->get();

        return $customer;
    }

    //recupera evento,cliente e suas respectivas mesas
    public function getEventsCustomer($customer_id)
    {
        return Customer::join('events', 'events.customer_id', '=', 'customers.customer_id')
        ->select('events.event_id', 'events.customer_id', 'customers.customer_name', 'events.event_name', 'events.event_quant_mesas')
        ->where('customers.customer_id', '=', $customer_id)
        ->orderBy('customer_name', 'event_quant_mesas', 'ASC')
        ->orderBy('event_quant_mesas', 'ASC')
        ->get();
    }

    //cadastra mesas na tabela de lançamento de mesas
    public function postTables(Request $request)
    {
        Table::create($request->all());

        $json = array('success' => 'Sucesso ao cadastrar mesa(s)!!');

        return $json;
    }

    //atualiza a quantidade de mesas na tabela de eventos
    public function updateEventQuantTables(Request $request, $id)
    {
      $validator = Validator::make($request->all(), $this->validateForm($request));

      if ($validator->fails()) {
        return response($validator->errors()->all());
      } else {
        $event = Event::findOrFail($id);
        $event->update($request->all());
        $json = array('status' => '1', 'success' => 'A quantidade de mesas foi atualizada com sucesso !!!');
        return $json;
      }
    }

    //valida os campos do formulário
    private function validateForm()
    {
      $rules = [
        'event_id' => 'required',
        'event_quant_mesas' => 'required|integer',
      ];

      return $rules;
    }
}
