<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOperational extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'check',
        'stnk',
        'bpkb',
        'kunci',
        'plate_number',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
