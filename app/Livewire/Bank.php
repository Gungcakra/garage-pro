<?php

namespace App\Livewire;

use App\Models\Bank as ModelsBank;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Bank extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $bankId, $name, $account_number, $amount, $idToDelete;
    protected $listeners = ['deleteBank'];
    public $search = '';
    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });

        if (!$userPermissions->contains('masterdata-bank')) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.bank.index', [
            'data' => ModelsBank::when($this->search, function ($query) {
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
        $this->bankId = null;
        $this->reset(['name', 'account_number', 'amount']);
        $this->dispatch('hide-modal');
    }
    public function create()
    {
        $this->openModal();
    }
    public function store()
    {
        try {
            $this->validate([
            'name' => 'required',
            'account_number' => 'required',
            'amount' => 'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }
        
        ModelsBank::updateOrCreate(
            ['id' => $this->bankId],
            [
                'name' => $this->name,
                'account_number' => $this->account_number,
                'amount' => $this->amount,
            ]
        );

        $this->dispatch('success', 'Bank created successfully.');
        $this->closeModal();
    }
    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Are you sure you want to delete this bank?');
    }
    public function deleteBank()
    {
        ModelsBank::destroy($this->idToDelete);
        $this->dispatch('delete-success', 'Bank deleted successfully.');
    }
    public function edit($id)
    {
        $this->bankId = $id;
        $bank = ModelsBank::find($id);
        $this->fill($bank->only(['name', 'account_number', 'amount']));
        $this->openModal();
    }
    public function update()
    {

        try{
            $this->validate([
                'name' => 'required',
                'account_number' => 'required',
                'amount' => 'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('error', collect($e->errors())->flatten()->first());
            return;
        }


        ModelsBank::updateOrCreate(
            ['id' => $this->bankId],
            [
                'name' => $this->name,
                'account_number' => $this->account_number,
                'amount' => $this->amount,
            ]
        );

        $this->dispatch('success', 'Bank updated successfully.');
        $this->closeModal();
    }
}
