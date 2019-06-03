<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class warehouseinv extends Model
{
    //
    protected $fillable = [
        'material_id',
        'warehouse_id',
        'quantity',
        'remark',
    ];


}
