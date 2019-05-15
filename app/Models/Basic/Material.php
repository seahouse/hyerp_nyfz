<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $fillable = [
        'number',
        'name',
        'material_cat_id',
        'note',
    ];
}
