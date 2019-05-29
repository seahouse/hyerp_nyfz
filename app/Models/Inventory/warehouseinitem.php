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

    public function material() {
        return $this->belongsTo('App\Models\Basic\Material');
    }

    public function warehouseinhead() {
        return $this->belongsTo('App\Models\Inventory\warehouseinhead');
    }

}
