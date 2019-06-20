<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'pohead_id',
        'amount',
        'paydate',
        'operator_id',
        'paymethod',
        'remark',
    ];

    public function pohead() {
        return $this->hasMany('App\Models\Purchase\Purchaseorder', 'id', 'pohead_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'operator_id');
    }
}
