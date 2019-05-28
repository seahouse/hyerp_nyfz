<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class warehouseinhead extends Model
{
    //
    protected $table = 'warehouseinheads';

    protected $fillable = [
        'number',
        'date',
        'type',
        'pohead_id',
        'vendor_id',
        'warehouse_id',
        'remark',
    ];

    public function warehouseinitem() {
        return $this->hasMany('App\Models\Inventory\Warehouseinitem', 'warehouseinhead_id', 'id');
    }

    public function warehouse() {
        return $this->hasOne('App\Models\Inventory\Warehouse', 'id', 'warehouse_id');
    }

    public function vendor() {
        return $this->hasOne('App\Models\Purchase\Vendor', 'id', 'vendor_id');
    }

    public function pohead() {
        return $this->hasOne('App\Models\Purchase\Purchaseorder', 'id', 'pohead_id');
    }
}
