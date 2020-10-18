<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'pack_id' => 'array',
    ];

}
