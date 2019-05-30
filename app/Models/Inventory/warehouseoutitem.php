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

    public function material() {
        return $this->belongsTo('App\Models\Basic\Material');
    }

    public function warehouseouthead() {
        return $this->belongsTo('App\Models\Inventory\warehouseouthead');
    }

    public function sohead() {
        return $this->hasOne('App\Models\Sales\Sohead', 'id', 'sohead_id');
    }
}
