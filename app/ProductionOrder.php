<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductionOrder extends Model
{
    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function colore()
    {
        return $this->hasMany(Color::class);
    }
    public function productionplanning()
    {
        return $this->hasMany(ProductionPlanning::class);

    }
    public function deviceorde()
    {
        return $this->hasMany(DeviceOrders::class);

    }



}
