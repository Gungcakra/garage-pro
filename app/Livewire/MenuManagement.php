<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class MenuManagement extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.menu-management');
    }
}
