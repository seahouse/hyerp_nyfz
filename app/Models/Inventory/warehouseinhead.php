<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class warehouseinhead extends Model
{
    //
    protected $fillable = [
        'number',
        'date',
        'type',
        'pohead_id',
        'vendor_id',
        'remark',
    ];
}