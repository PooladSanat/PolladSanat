<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
      'side_company'=>'array',
      'sex_company'=>'array',
      'title_company'=>'array',
      'name_company'=>'array',
      'inside_company'=>'array',
      'email_company'=>'array',
      'phone_company'=>'array',
      'tel_company_company'=>'array',
    ];
    public function invoices()
    {
        return $this->belongsTo(Invoice::class);

    }
}
