<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    protected $table = 'submenus'; 
    protected $fillable = ['menu_id', 'name', 'route', 'order'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
