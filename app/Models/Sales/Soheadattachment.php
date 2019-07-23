<?php

namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;

class Soheadattachment extends Model
{
    //
    protected $fillable = [
        'sohead_id',
        'type',
        'filename',
        'path',
    ];
}
