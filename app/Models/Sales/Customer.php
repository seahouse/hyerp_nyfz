<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'active',
        'number',
        'name',
        'contact_name',
        'contact_phone',
        'remark',
    ];


}
