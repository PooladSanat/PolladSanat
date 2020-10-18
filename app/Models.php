<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $guarded = ['id'];

    public function formats()
    {
        return $this->hasMany(Format::class);
    }

}
