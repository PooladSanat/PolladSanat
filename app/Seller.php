<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    protected $guarded = ['id'];

    public function color()
    {
        return $this->belongsTo(Color::class);

    }

}
