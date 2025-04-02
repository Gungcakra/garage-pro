<?php

namespace App\Livewire;

use App\Models\Service;
use App\Models\ServiceOperational;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('layouts.admin')]
class ServiceDetail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $ServiceOperationalId, $customer_id, $code, $check, $plate_number, $stnk, $bpkb, $kunci, $status, $idToDelete, $tabService = true, $tabSparepart, $serviceAdd = [], $sparepartAdd = [];
    protected $listeners = ['loadDataService', 'loadDataSparepart'];
    
    public $search = '', $searchService = '', $searchSparepart = '';
    public function render()
    {
       if($this->ServiceOperationalId){

        $data = ServiceOperational::where('id', $this->ServiceOperationalId)->first();
        return view('livewire.pages.admin.masterdata.operational.service-detail', [
            'data' => $data,
            'services' => Service::when($this->searchService, function ($query) {
                $query->where('name', 'like', '%' . $this->searchService . '%');
            })->paginate(10),

            'spareparts' => \App\Models\SparePart::when($this->searchSparepart, function ($query) {
                $query->where('name', 'like', '%' . $this->searchSparepart . '%');
            })->paginate(10),
        ]);
       }else{
        return view('livewire.pages.admin.masterdata.operational.index',[
            'data' => ServiceOperational::when($this->search, function ($query) {
                $query->where('code', 'like', '%' . $this->search . '%');
            })->paginate(10),
        ]);
       }
    }

    public function finalize($id)
    {
        $this->ServiceOperationalId = $id;   
    }
    public function loadDataService()
    {
        $this->tabService = true;
        $this->tabSparepart = false;
    }
    public function loadDataSparepart()
    {
        $this->tabService = false;
        $this->tabSparepart = true;
    }
  

    public function addService($id)
    {
        $this->tabService = true;
        $this->tabSparepart = false;
        $serviceData = Service::find($id);
        if ($serviceData) {
            foreach ($this->serviceAdd as $service) {
            if ($service['id'] === $serviceData->id) {
                $this->dispatch('error', 'Service already added.');
                return;
            }
            }
            $this->serviceAdd[] = [
            'id' => $serviceData->id,
            'name' => $serviceData->name,
            'price' => $serviceData->price,
            ];
        } else {
            $this->dispatch('error', 'Service not found.');
        }
    }
    public function addSparepart($id)
    {
        $this->tabService = false;
        $this->tabSparepart = true;
        $sparepartData = \App\Models\SparePart::find($id);
        if ($sparepartData) {
            foreach ($this->sparepartAdd as &$sparepart) {
            if ($sparepart['id'] === $sparepartData->id) {
                $sparepart['qty'] = isset($sparepart['qty']) ? $sparepart['qty'] + 1 : 2;
                $sparepart['price'] = $sparepartData->price * $sparepart['qty'];
                return;
            }
            }
            $this->sparepartAdd[] = [
            'id' => $sparepartData->id,
            'name' => $sparepartData->name,
            'brand' => $sparepartData->brand,
            'stock' => $sparepartData->stock,
            'price' => $sparepartData->price,
            'qty' => 1,
            ];
        } else {
            $this->dispatch('error', 'Spare part not found.');
        }
    }
}
