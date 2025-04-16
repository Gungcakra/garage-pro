<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    protected $guarded = ['id'];

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
}
