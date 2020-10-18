<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceOrders extends Model
{
    protected $guarded = ['id'];

    public function productorder()
    {
        return $this->belongsTo(ProductionOrder::class,'order_id','id');

    }
    public function product()
    {
        return $this->belongsTo(Product::class);

    }




}
