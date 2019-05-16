<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //
    protected $fillable = [
        'number',
        'name',
        'material_cats_id',
        'note',
    ];

    public function material_cat()
    {

        return $this->hasone('App\Models\Basic\Material_cat','id', 'material_cat_id');
    }
}
