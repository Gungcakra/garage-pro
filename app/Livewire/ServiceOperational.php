<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\ServiceOperational as ModelsServiceOperational;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ServiceOperational extends Component
{
    public $ServiceOperationalId, $customer_id, $code, $check, $plate_number, $stnk, $bpkb, $kunci, $status, $idToDelete, $name, $email, $phone, $address, $latestId;

    public function openModal()
    {
        $this->dispatch('show-modal');
    }
    public function closeModal()
    {
        $this->reset(['name', 'email', 'phone', 'address']);
        $this->dispatch('hide-modal');
    }

    public function createCustomer()
    {
        $this->openModal();
    }

    public function storeCustomer()
    {

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
        ]);

        Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);
        $this->dispatch('success', 'Customer added successfully.');
        $this->closeModal();
    }

    public function store()
    {
        $this->validate([
            'check' => 'required|string|max:255'
        ]);
        ModelsServiceOperational::create([
            'code' => $this->code,
            'customer_id' => $this->customer_id,
            'check' => $this->check,
            'stnk' => $this->stnk,
            'bpkb' => $this->bpkb,
            'kunci' => $this->kunci,
            'plate_number' => $this->plate_number,
            'status' => $this->status,
        ]);
        $this->dispatch('success', 'Service operational created successfully.');
        $this->reset([ 'customer_id', 'check', 'stnk', 'bpkb', 'kunci', 'plate_number', 'status']);
        $this->latestId = ModelsServiceOperational::where('code', $this->code)->first()->id;
        $this->js("window.location.href = '" . route('serviceinvoice', ['id' => $this->latestId]) . "'");

    }
    public function mount()
    {
        $this->code = '#' . now()->format('YmdHis');
        $this->status = 0;
    }

    public function getInvoice($id)
    {
        
        $data = ModelsServiceOperational::where('id', $id)->first();
        return view('livewire.pages.admin.operational.service-invoice', [
            'data' => $data,
        ]);
    }
    public function render()
    {
        return view('livewire.pages.admin.operational.service-operational', [
            'customers' => Customer::orderBy('id', 'desc')->get(),

        ]);
    }
}
