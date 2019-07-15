<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Maintainrecord extends Model
{
    //
    protected $fillable = [
        'sohead_id',
        'seq',
        'raisedate',
        'descrip',
        'handler',
        'handlerdate',
        'handlemethod',
        'result',
        'remark',
    ];
}
