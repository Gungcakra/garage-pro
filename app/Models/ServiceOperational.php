<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOperational extends Model
{
    protected $fillable = [
        'customer_id',
        'check',
        'stnk',
        'bpkb',
        'kunci',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
