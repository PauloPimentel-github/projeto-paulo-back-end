<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
  //retorna todos os eventos cadastrados no banco
  public function getEvents()
  {
    return Event::all();
  }

  //retorna apenas um eventos recuperado pelo campo id
  public function getEvent($event_id)
  {
    return Event::find($event_id);
  }

  //retorna apenas a coluna de quantidade de mesas
  public function getEventQuantTables($event_id)
  {
    return Event::select('events.event_quant_mesas')
    ->where('events.event_id', '=', $event_id)
    ->orderBy('events.event_quant_mesas', 'ASC')
    ->get();
  }

  //cadastra um novo eventos no banco
  public function createEvent(Request $request)
  {
    $validator = Validator::make($request->all(), $this->validateForm($request));

    if ($validator->fails()) {
      return response($validator->errors()->all());
    } else {
      Event::create($request->all());
      $json = array('status' => 1, 'success' => 'Evento cadastrado com sucesso !!');
      return $json;
    }

  }

  //atualiza um eventos no banco
  public function updateEvent(Request $request, $id)
  {
    $validator = Validator::make($request->all(), $this->validateForm($request));

    if ($validator->fails()) {
      return response($validator->errors()->all());
    } else {
      $event = Event::findOrFail($id);
      $event->update($request->all());
      $json = array('status' => 0, 'success' => 'Evento atualizado com sucesso !!');
      return $json;
    }
  }

  //deleta um eventos no banco
  public function deleteEvent(Request $request, $id)
  {
    $event = Event::findOrFail($id);

    if ($event->delete()) {
      $json = array('success' => 'Evento deletado com sucesso !!');
      return $json;
    }
  }

  //valida os campos do formulário
  private function validateForm()
  {
    $rules = [
      'customer_id' => 'required',
      'event_name' => 'required|string||max:100',
      'event_local' => 'required|string|max:100',
      'event_date' => 'required|date',
      'event_quant_mesas' => 'required|integer'
    ];

    return $rules;
  }
}
