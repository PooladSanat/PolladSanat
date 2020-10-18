<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Polymeric extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);

    }

    public function barnmaterial()
    {
        return $this->belongsTo(BarnMaterial::class);

    }

}
