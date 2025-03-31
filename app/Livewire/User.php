<?php

namespace App\Livewire;

use App\Models\User as ModelsUser;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Layout('layouts.admin')]

class User extends Component
{
    public $userId, $name, $email, $password,  $idToDelete, $selectedRole;
    protected $listeners = ['deleteUser', 'loadData'];
    public $search = '';

    public function openModal()
    {
        $this->dispatch('show-modal');
    }
    public function closeModal()
    {
        $this->userId = null;
        $this->reset(['name', 'email', 'password']);
        $this->dispatch('hide-modal');
    }
    public function create()
    {
        $this->openModal();
    }
    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'selectedRole' => 'required',
        ]);
        
       $rolee = $this->selectedRole;
       ModelsUser::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $rolee
        ]);
        
        

        $this->dispatch('success', 'User created successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $user = ModelsUser::find($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $role = $user->role;
        $this->selectedRole = $role;
        $this->openModal();
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'selectedRole' => 'required',
            'password' => 'nullable|min:6',
        ]);
        try {
            $user = ModelsUser::find($this->userId);
            $dataToUpdate = [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->selectedRole
            ];

            if (!empty($this->password)) {
                $dataToUpdate['password'] = bcrypt($this->password);
            }

            $user->update($dataToUpdate);

            $this->dispatch('success', 'User updated successfully.');
            $this->closeModal();
        } catch (\Exception $e) {
            $this->dispatch('error', 'Failed to update user: ' . $e->getMessage());
        }
    }
    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Are you sure you want to delete this user?');
    }
    public function deleteUser()
    {
        try {
            $user = ModelsUser::find($this->idToDelete);
            if ($user) {
                $user->delete();
                $this->dispatch('delete-success', params: 'User deleted successfully.');
            } else {
                $this->dispatch('error', 'User not found.');
            }
        } catch (\Exception $e) {
            $this->dispatch('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.user',[
            'data' => ModelsUser::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->paginate(10),
            'roles' => Role::all(),
        ]);
    }
}
