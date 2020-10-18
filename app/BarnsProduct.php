<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarnsProduct extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);

    }

    public function color()
    {
        return $this->belongsTo(Color::class);

    }

}
