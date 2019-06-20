<?php

namespace App\Models\Finance;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    //
    protected $fillable = [
        'sohead_id',
        'amount',
        'receivedate',
        'operator_id',
        'paymethod',
        'remark',
    ];

    public function phhead() {
        return $this->hasMany('App\Models\Purchase\Purchaseorder', 'id', 'pohead_id');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'operator_id');
    }
}
