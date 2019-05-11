<?php

namespace App\Models\Purchase;

use Illuminate\Database\Eloquent\Model;

class Sohead_Pohead extends Model
{
    //
    protected $table = 'sohead_pohead';

    protected $fillable = [
        'sohead_id',
        'pohead_id',
    ];
}
