<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Poheadattachment extends Model
{
    //
    protected $fillable = [
        'pohead_id',
        'type',
        'filename',
        'path',
    ];
}
