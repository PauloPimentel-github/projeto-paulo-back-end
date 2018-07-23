<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';
    protected $primaryKey = 'table_id';
    protected $fillable = ['customer_id', 'table_quant', 'table_register'];
}
