<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = ['id'];

    public function sellers()
    {
        return $this->hasMany(Seller::class);

    }


    public function barncolor()
    {
        return $this->hasMany(BarnColor::class);

    }


    public function colorscrap()
    {
        return $this->hasMany(ColorScrap::class);
    }

    public function barntemporary()
    {
        return $this->hasMany(BarnTemporary::class);

    }

    public function barnproduct()
    {
        return $this->hasMany(BarnsProduct::class);

    }

    public function product()
    {
        return $this->belongsTo(Product::class);

    }
    public function productorder()
    {
        return $this->belongsTo(ProductionOrder::class);

    }

}
