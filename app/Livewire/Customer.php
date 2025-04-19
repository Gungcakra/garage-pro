<?php

namespace App\Livewire;

use App\Models\Customer as ModelsCustomer;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Customer extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $CustomerId, $name, $email, $phone, $address, $idToDelete;
    protected $listeners = ['deleteCustomer'];
    public $search = '';


   public function mount()
   {
    $userPermissions = Auth::user()->roles->flatMap(function ($role) {
        return $role->permissions->pluck('name');
    });

    if (!$userPermissions->contains('masterdata-customer')) {
        abort(403, 'Unauthorized action.');
    }
   }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.customer.index', [
            'data' => ModelsCustomer::when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })->paginate(10),
        ]);
    }

    public function openModal()
    {
        $this->dispatch('show-modal');
    }
    
    public function closeModal()
    {
        $this->CustomerId = null;
        $this->reset(['name', 'email', 'phone', 'address']);
        $this->dispatch('hide-modal');
    }
    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        try{
            $this->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }

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
        $this->fill($customer->only(['name', 'email', 'phone', 'address']));
        $this->openModal();
    }

    public function update(){
        $customer = ModelsCustomer::find($this->CustomerId);
        try{

            $this->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }
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
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Are you sure you want to delete this customer?');

     
    }
    
    public function deleteCustomer()
    {
        if($this->idToDelete)
        {
            $customer = ModelsCustomer::find($this->idToDelete);
            $customer->delete();
            $this->dispatch('delete-success', 'Customer deleted successfully.');
        }
    }
}
