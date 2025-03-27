<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use Livewire\Attributes\Layout; // Tambahkan ini
#[Layout('layouts.admin')] // Gunakan layout di Livewire 3
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.masterdata.dashboard')->with([
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'menus' => Menu::with('submenus')->get()
        ]);;
    }
}
