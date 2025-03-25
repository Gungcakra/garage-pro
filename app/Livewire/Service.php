<?php

namespace App\Livewire;

use App\Models\Service as ModelsService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Service extends Component
{
    public $ServiceId, $name, $price, $idToDelete;
    protected $listeners = ['deleteService'];
    public function render()
    {
        return view('livewire.pages.admin.service', [
            'data' => ModelsService::all(),
        ]);
    }
    
    public function openModal()
    {
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
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
