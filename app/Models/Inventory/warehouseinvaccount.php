<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class warehouseinvaccount extends Model
{
    //
    protected $fillable = [
        'material_id',
        'warehouse_id',
        'quantity',
        'date',
        'flag',
        'warehouseoutin_id',
        'remark',
    ];
}
