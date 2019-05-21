<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    //
    protected $table = 'poheads';

    protected $fillable = [
        'number',
        'descrip',
        'vendor_id',
        'orderdate',
        'total_amount',
        'status',
        'poheadc_id',
    ];

    public function poitems() {
        return $this->hasMany('App\Models\Purchase\Poitem', 'pohead_id', 'id');
    }

    public function vendor() {
        return $this->hasOne('App\Models\Purchase\Vendor', 'id', 'vendor_id');
    }

    public function soheads() {
        return $this->belongsToMany('App\Models\Sales\Sohead', 'sohead_pohead', 'pohead_id');
    }
}
