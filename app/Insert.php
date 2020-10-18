<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insert extends Model
{
    protected $guarded = ['id'];

    public function modelProducts()
    {
        return $this->hasMany(ModelProduct::class);
    }
}
