<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Table;

class ReportTableController extends Controller
{
    //retorna clientes e mesas
    public function getReportTables()
    {
        return Customer::join('tables', 'tables.customer_id', '=', 'customers.customer_id')
        ->select('tables.table_id', 'tables.customer_id', 'customers.customer_name', 'tables.table_quant')
        ->orderBy('customers.customer_name', 'ASC')
        ->orderBy('tables.table_quant', 'ASC')
        ->get();
    }

    //atualiza mesas no banco
    public function updateTable(Request $request, $table_id)
    {
        $table = Table::findOrFail($table_id);
        $table->update($request->all());

        $json = array('success' => 'Sucesso ao atualizar!!');

        return $json;
    }

    //deleta mesas no banco
    public function deleteTable(Request $request, $table_id)
    {
        $table = Table::findOrFail($table_id);
        $table->delete();

        $json = array('success' => 'Sucesso ao deletar!!');

        return $json;
    }
}
