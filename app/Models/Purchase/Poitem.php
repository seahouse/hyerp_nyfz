<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Poitem extends Model
{
    //
    protected $fillable = [
        'pohead_id',
        'poitemc_id',
        'quantity',
        'quantityreceived',
        'remark',
    ];

    public function pohead() {
        return $this->belongsTo('App\Models\Purchase\Purchaseorder');
//        return $this->hasOne('App\Models\Purchaseorderc\Poitemc', 'id', 'poitemc_id');
    }

    public function poitemc() {
        return $this->belongsTo('App\Models\Purchaseorderc\Poitemc');
//        return $this->hasOne('App\Models\Purchaseorderc\Poitemc', 'id', 'poitemc_id');
    }

    public function asnpackagings() {
        return $this->hasMany('\App\Models\Purchase\Asnpackaging');
    }

    public function poitemrolls() {
        return $this->hasMany('\App\Models\Purchase\Poitemroll');
    }

    public function asnitems() {
        return $this->hasManyThrough('\App\Models\Purchase\Asnitem', '\App\Models\Purchase\Asnpackaging');
    }
}
