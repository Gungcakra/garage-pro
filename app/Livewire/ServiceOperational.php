<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\ServiceOperational as ModelsServiceOperational;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class ServiceOperational extends Component
{
    public $ServiceOperationalId, $customer_id, $code, $vehicle_type, $check, $plate_number, $stnk,  $kunci, $status, $idToDelete, $name, $email, $phone, $address, $latestId, $invoice, $invoiceId, $qrCode, $writer, $result, $dataUri;

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
            'check' => 'required|string|max:255',
            'vehicle_type' => 'required|string|max:255',
            
        ]);
        ModelsServiceOperational::create([
            'code' => $this->code,
            'customer_id' => $this->customer_id,
            'check' => $this->check,
            'vehicle_type' => $this->vehicle_type,
            'stnk' => $this->stnk,
            'kunci' => $this->kunci,
            'plate_number' => $this->plate_number,
            'status' => $this->status,
        ]);
        $this->dispatch('success', 'Service operational created successfully.');
        $this->reset([ 'customer_id', 'check', 'vehicle_type', 'stnk', 'kunci', 'plate_number', 'status']);
        $this->latestId = ModelsServiceOperational::where('code', $this->code)->first()->id;
        $this->getInvoice($this->latestId);

    }
    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });
    
        if (!$userPermissions->contains('operational-serviceoperational')) {
            abort(403, 'Unauthorized action.');
        }
        $this->code = '#' . now()->format('YmdHis');
        $this->status = 0;
    }

    public function getInvoice($id)
    {
        $this->invoiceId = $id;
        $this->invoice = true;
        $code = ModelsServiceOperational::where('id', $this->invoiceId)->first();
        $this->code = $code->code;
        $qrCode = new \Endroid\QrCode\QrCode($this->code);
        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $result = $writer->write($qrCode);
        $this->dataUri = $result->getDataUri();
       
    }
    public function removeInvoice()
    {
        $this->invoiceId = null;
        $this->invoice = false;
    }
    public function render()
    {
        if($this->invoiceId){
            $data = ModelsServiceOperational::where('id', $this->invoiceId)->first();

            return view('livewire.pages.admin.operational.service.service-invoice', [
                'data' => $data,
            ]);
        }else{     
            return view('livewire.pages.admin.operational.service.service-operational', [
                'customers' => Customer::orderBy('id', 'desc')->get(),
    
            ]);
        }
    }


}
