<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $guarded = ['id'];


    public function eventmachine()
    {
        return $this->hasMany(EventsMachine::class);

    }
    public function pm()
    {
        return $this->hasMany(PMMachine::class);

    }
    public function barntemporary()
    {
        return $this->hasMany(BarnTemporary::class);

    }

}
