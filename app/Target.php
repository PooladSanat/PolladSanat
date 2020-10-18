<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany(User::class);

    }

}
