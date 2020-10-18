<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductQueue extends Model
{
    protected $guarded = ['id'];


    public function invoice()
    {
        return $this->belongsTo(Invoice::class);

    }

}
