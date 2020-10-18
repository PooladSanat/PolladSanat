<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PMFormat extends Model
{
    protected $guarded = ['id'];


    public function format()
    {
        return $this->belongsTo(Format::class);

    }
}
