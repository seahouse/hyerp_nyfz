<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Poitem extends Model
{
    //
    protected $fillable = [
        'pohead_id',
        'material_id',
        'quantity',
        'unitprice',
        'remark',
    ];

    public function pohead() {
        return $this->belongsTo('App\Models\Purchase\Purchaseorder');
//        return $this->hasOne('App\Models\Purchaseorderc\Poitemc', 'id', 'poitemc_id');
    }

    public function material() {
        return $this->belongsTo('App\Models\Basic\Material');
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
