<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    //
    protected $fillable = [
        'name',
        'address',
        'contact_name',
        'contact_phone',
        'note',
    ];
}
