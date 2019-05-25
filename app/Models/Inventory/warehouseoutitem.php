<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class warehouseoutitem extends Model
{
    //
    protected $fillable = [
        'warehouseouthead_id',
        'material_id',
        'quantity',
        'sohead_id',
        'remark',
    ];
}
