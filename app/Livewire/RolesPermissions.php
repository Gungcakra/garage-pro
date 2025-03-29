<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]

class RolesPermissions extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.masterdata.roles-permissions');
    }
}
