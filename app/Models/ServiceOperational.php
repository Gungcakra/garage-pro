<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceOperational extends Model
{
    protected $fillable = [
        'code',
        'customer_id',
        'check',
        'vehicle_type',
        'stnk',
        'kunci',
        'plate_number',
        'payment_method',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'service_transactions')
            ->withPivot('price')
            ->withTimestamps();
    }

    
    public function spareparts()
    {
        return $this->belongsToMany(SparePart::class, 'sparepart_transactions')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

}
