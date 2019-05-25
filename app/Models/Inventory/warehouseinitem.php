<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class warehouseinitem extends Model
{
    //
    protected $fillable = [
        'warehouseinhead_id',
        'material_id',
        'quantity',
        'unitprice',
        'amount',
        'taxrate',
        'remark',
    ];
}
