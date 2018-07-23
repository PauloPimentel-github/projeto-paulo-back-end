<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'event_id';
    protected $fillable = ['customer_id', 'event_name', 'event_local', 'event_date', 'event_quant_mesas'];
}
