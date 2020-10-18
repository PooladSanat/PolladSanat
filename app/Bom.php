<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{

    protected $guarded = ['id'];

    public function products()
    {
        return $this->belongsToMany(Product::class);

    }


}
