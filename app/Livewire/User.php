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
        ]);

       ModelsUser::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role'=> $this->selectedRole
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
        $this->password = $user->password;
        $this->openModal();
    }
    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = ModelsUser::find($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->dispatch('success', 'User updated successfully.');
        $this->closeModal();
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
