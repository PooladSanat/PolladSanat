<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelProduct extends Model
{
    protected $guarded = ['id'];

    public function format()
    {
        return $this->belongsTo(Format::class);
    }

    public function insert()
    {
        return $this->belongsTo(Insert::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
