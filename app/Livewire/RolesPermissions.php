<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin')]

class RolesPermissions extends Component
{
    public $roles, $permissions, $name, $selectedRole, $selectedPermissions = [], $roleId, $idRoleToDelete;
    protected $listeners = ['deleteRoleConfirm'];

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

    public function closeModal()
    {
        $this->reset(['name']);
        $this->dispatch('hide-modal');
    }
    public function create()
    {
        $this->openModal();
    }

    public function storeRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name',
        ]);
        Role::create(['name' => $this->name]);
        $this->dispatch('success', 'Role created successfully');
        $this->closeModal();
        $this->fetchRoles();
    }

    public function editRole($id)
    {
        $this->roleId = $id;
        $role = Role::find($id);
        if ($role) {
            $this->name = $role->name;
            $this->dispatch('show-modal');
        } else {
            $this->dispatch('error', 'Role not found');
        }
    }

    public function updateRole()
    {
        $this->validate([
            'name' => 'required|unique:roles,name,' . $this->roleId,
        ]);
        $role = Role::find($this->roleId);
        if ($role) {
            $role->name = $this->name;
            $role->save();
            $this->dispatch('success', 'Role updated successfully');
            $this->closeModal();
            $this->fetchRoles();
        } else {
            $this->dispatch('error', 'Role not found');
        }
    }

    public function deleteRole($id)
    {
        $this->idRoleToDelete = $id;
        $this->dispatch('delete-role', 'Are you sure you want to delete this role?');

    }
    public function deleteRoleConfirm()
    {
        if($this->idRoleToDelete) {
            $role = Role::find($this->idRoleToDelete);
            if ($role) {
                $role->delete();
                $this->dispatch('delete-success', 'Role deleted successfully');
                $this->fetchRoles();
            } else {
                $this->dispatch('error', 'Role not found');
            }
        }
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.roles-permissions');
    }
}
