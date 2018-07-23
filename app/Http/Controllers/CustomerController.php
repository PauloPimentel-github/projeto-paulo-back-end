<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //retorna todos os clientes cadastrados no banco
    public function getCustomers()
    {
        return Customer::all();
    }

    //retorna apenas um cliente recuperado pelo campo id
    public function getCustomer($customer_id)
    {
        return Customer::find($customer_id);
    }

    //cadastra um novo cliente no banco
    public function createCustomer(Request $request)
    {
        return Customer::create($request->all());
    }

    //atualiza um cliente no banco
    public function updateCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return $customer;
    }

    //deleta um cliente no banco
    public function deleteCustomer(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return 204;
    }
}
