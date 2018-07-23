<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'customer_id';
    protected $fillable = ['customer_name', 'customer_cpf', 'customer_address', 'customer_cep'];
}
