<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarnTemporary extends Model
{
    protected $guarded = ['id'];

    public function device()
    {
        return $this->belongsTo(Device::class);

    }

    public function product()
    {
        return $this->belongsTo(Product::class);

    }

    public function color()
    {
        return $this->belongsTo(Color::class);

    }
}
