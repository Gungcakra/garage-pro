<?php

namespace App\Livewire;

use App\Models\Service as ModelsService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Service extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ServiceId, $name, $price, $idToDelete;
    protected $listeners = ['deleteService', 'loadData'];
    public $search = '';
    public function render()
    {
        return view('livewire.pages.admin.service', [
            'data' => ModelsService::when($this->search, function ($query) {
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
        $this->ServiceId = null;
        $this->reset(['name','price']);
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
            'price' => 'required',
        ]);

        ModelsService::create([
            'name' => $this->name,
            'price' => $this->price,
        ]);

        $this->dispatch('success', 'Service created successfully.');
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->ServiceId = $id;
        $service = ModelsService::find($id);
        $this->name = $service->name;
        $this->price = $service->price;
        $this->openModal();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        ModelsService::find($this->ServiceId)->update([
            'name' => $this->name,
            'price' => $this->price,
        ]);

        $this->dispatch('success', 'Service updated successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Are you sure you want to delete this service?');
    }
    
    public function deleteService()
    {
        if($this->idToDelete){
            ModelsService::find($this->idToDelete)->delete();
            $this->dispatch('delete-success', 'Service deleted successfully.');
        }
    }
}
