<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin')]

class RolesPermissions extends Component
{
    public $roles, $permissions, $name, $selectedRole, $selectedPermissions = [];

    public function mount()
    {
        $this->fetchRoles();
        $this->permissions = Permission::all();
    }
    public function fetchRoles()
    {
        $this->roles = Role::with('permissions')->get();
    }

    public function openModal()
    {
        $this->dispatch('show-modal');
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.roles-permissions');
    }
}
