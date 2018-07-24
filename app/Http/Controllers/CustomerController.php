<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use LaravelLegends\PtBrValidator\ValidatorProvider;

class CustomerController extends Controller
{
  //retorna todos os clientes cadastrados no banco
  public function getCustomers()
  {
    $customer = Customer::all();

    if (isset($customer)) {
      return $customer;
    }
  }

  //retorna apenas um cliente recuperado pelo campo id
  public function getCustomer($customer_id)
  {
    return Customer::find($customer_id);
  }

  //cadastra um novo cliente no banco
  public function createCustomer(Request $request)
  {
    Customer::create($request->all());
    $json = array('success' => 'Usuário cadastrado com sucesso !!');
    return $json;
  }

  //atualiza um cliente no banco
  public function updateCustomer(Request $request, $id)
  {
    $customer = Customer::findOrFail($id);

    if ($customer->update($request->all())) {
      $json = array('status' => '1', 'success' => 'Cliente atualizado com sucesso !!');
      return $json;
    }
  }

  //deleta um cliente no banco
  public function deleteCustomer(Request $request, $id)
  {
    $customer = Customer::findOrFail($id);

    if ($customer->delete()) {
      $json = array('success' => 'Cliente deletado com sucesso !!');
      return $json;
    }

    return $json;
  }
}
