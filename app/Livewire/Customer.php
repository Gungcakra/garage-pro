<?php

namespace App\Livewire;

use App\Models\Customer as ModelsCustomer;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Customer extends Component
{
    public $CustomerId, $name, $email, $phone, $address;
    public function render()
    {
        return view('livewire.pages.admin.customer', [
            'data' => ModelsCustomer::all(),
        ]);
    }

    public function openModal()
    {
        $this->dispatch('show-modal');
    }
    
    public function closeModal()
    {
        $this->reset(['name', 'email', 'phone', 'address']);
        $this->dispatch('hide-modal');
    }
    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

       ModelsCustomer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $this->dispatch('success', 'Customer created successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->CustomerId = $id;
        $customer = ModelsCustomer::find($id);
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->phone = $customer->phone;
        $this->address = $customer->address;
        $this->openModal();
    }

    public function update(){
        $customer = ModelsCustomer::find($this->CustomerId);
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $customer->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);
        $this->dispatch('success', 'Customer updated successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $customer = ModelsCustomer::findOrFail($id);
        $customer->delete();
        $this->dispatch('success', 'Customer deleted successfully.');
        $this->closeModal();
    }
}
