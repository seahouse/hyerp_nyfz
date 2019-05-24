<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class warehouseouthead extends Model
{
    //
    protected $fillable = [
        'number',
        'date',
        'type',
        'warehouse_id',
        'remark',
    ];
}
