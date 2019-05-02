<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Sohead extends Model
{
    //
    protected $fillable = [
        'number',
        'descrip',
        'customer_id',
        'orderdate',
        'salesmanager_id',
    ];
}
