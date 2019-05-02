<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Asnorder extends Model
{
    //
    protected $fillable = [
        'asnshipment_id',
        'pohead_id',
    ];

    public function pohead() {
        return $this->hasOne('App\Models\Purchase\Purchaseorder', 'id', 'pohead_id');
    }

    public function asnpackagings() {
        return $this->hasMany('\App\Models\Purchase\Asnpackaging');
    }
}
