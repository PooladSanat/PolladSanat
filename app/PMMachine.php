<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class PMMachine extends Model
{
    protected $guarded = ['id'];


    public function device()
    {
        return $this->belongsTo(Device::class);

    }





}
