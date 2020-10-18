<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarnColor extends Model
{
    protected $guarded = ['id'];

    public function color()
    {
        return $this->belongsTo(Color::class, 'id', 'color_id');

    }

}
