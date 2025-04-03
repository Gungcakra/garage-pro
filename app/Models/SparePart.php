<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'brand', 'price', 'stock'];

    public function serviceOperationals()
    {
        return $this->belongsToMany(ServiceOperational::class, 'spareparts_transactions')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }
}
