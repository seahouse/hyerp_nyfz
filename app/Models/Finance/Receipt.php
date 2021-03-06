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

    public function sohead() {
        return $this->belongsTo('App\Models\Sales\Sohead');
    }

    public function user() {
        return $this->hasOne('App\User', 'id', 'operator_id');
    }
    public function paymethodname() {
        return $this->hasOne('App\Models\Basic\Paymethod', 'id', 'paymethod');
    }
}
