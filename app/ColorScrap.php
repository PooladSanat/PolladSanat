<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColorScrap extends Model
{
    protected $guarded = ['id'];


    public function format()
    {
        return $this->belongsTo(Format::class);
    }
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

}
