<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Sparepart extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $SparePartId, $name, $brand, $price, $stock, $idToDelete;
    protected $listeners = ['deleteSparePart'];
    public $search = '';


    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });
    
        if (!$userPermissions->contains('masterdata-sparepart')) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function render()
    {
        return view('livewire.pages.admin.masterdata.sparepart.index', [
            'data' => \App\Models\SparePart::when($this->search, function ($query) {
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
        $this->SparePartId = null;
        $this->reset(['name', 'brand', 'price', 'stock']);
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
            'brand' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        \App\Models\SparePart::create([
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'stock' => $this->stock,
        ]);

        $this->dispatch('success', 'Spare part created successfully.');
        $this->closeModal();
    }
    public function edit($id)
    {
        $this->SparePartId = $id;
        $sparePart = \App\Models\SparePart::find($id);
        $this->name = $sparePart->name;
        $this->brand = $sparePart->brand;
        $this->price = $sparePart->price;
        $this->stock = $sparePart->stock;

        $this->openModal();
    }
    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validatedData) {
            $sparePart = \App\Models\SparePart::find($this->SparePartId);
            $sparePart->update([
            'name' => $this->name,
            'brand' => $this->brand,
            'price' => $this->price,
            'stock' => $this->stock,
            ]);

            $this->dispatch('success', 'Spare part updated successfully.');
            $this->closeModal();
        }
    }
    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Are you sure you want to delete this spare part?');
    }
    public function deleteSparePart()
    {
        $sparePart = \App\Models\SparePart::find($this->idToDelete);
        $sparePart->delete();

        $this->dispatch('delete-success', 'Spare part deleted successfully.');
        $this->dispatch('hide-delete-modal');
    }
}
