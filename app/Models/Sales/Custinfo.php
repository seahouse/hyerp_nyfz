<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Custinfo extends Model
{
    //
    protected $fillable = [
        'number',
        'name',
        'contact_name',
        'comments',
    ];


}
