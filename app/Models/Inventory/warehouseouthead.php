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

    public function warehouse() {
        return $this->hasOne('App\Models\Inventory\Warehouse', 'id', 'warehouse_id');
    }
}
