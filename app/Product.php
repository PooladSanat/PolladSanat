<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];

    public function characteristic()
    {
        return $this->belongsTo(ProductCharacteristic::class);
    }

    public function commodity()
    {
        return $this->belongsTo(Commodity::class);
    }

    public function formats()
    {
        return $this->hasMany(Format::class);
    }

    public function productionorder()
    {
        return $this->hasMany(ProductionOrder::class);
    }

    public function polymerics()
    {
        return $this->hasMany(Polymeric::class);

    }

    public function producttitle()
    {
        return $this->hasMany(ProductTitle::class);

    }

    public function boms()
    {
        return $this->belongsToMany(Bom::class);

    }

    public function modelProducts()
    {
        return $this->hasMany(ModelProduct::class);
    }

    public function barntemporary()
    {
        return $this->hasMany(BarnTemporary::class);

    }

    public function barnproduct()
    {
        return $this->hasMany(BarnsProduct::class);

    }

    public function color()
    {
        return $this->hasMany(Color::class);

    }
    public function deviceorde()
    {
        return $this->hasMany(DeviceOrders::class);

    }
}
