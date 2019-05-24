<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Sohead extends Model
{
    //
    protected $fillable = [
        'number',
        'name',
        'customer_id',
        'orderdate',
        'salesmanager_id',
        'total_amount',
        'duedate',
        'drawing_completed',
    ];

    public function customer() {
//        return $this->hasOne('App\Models\Sales\Customer', 'id', 'customer_id');
        return $this->belongsTo('App\Models\Sales\Customer');
    }
}
