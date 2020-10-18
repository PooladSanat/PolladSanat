<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsMachine extends Model
{
    protected $guarded = ['id'];


    public function device()
    {
        return $this->belongsTo(Device::class);

    }

}
