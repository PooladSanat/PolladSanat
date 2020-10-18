<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarnMaterial extends Model
{
    protected $guarded = ['id'];

    public function polymeric()
    {
        return $this->hasMany(Polymeric::class);

    }
}
