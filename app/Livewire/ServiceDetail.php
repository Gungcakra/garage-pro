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
    public $ServiceOperationalId, $customer_id, $code, $check, $plate_number, $stnk, $bpkb, $kunci, $status, $idToDelete, $tabService = true, $tabSparepart, $serviceAdd = [], $sparepartAdd = [], $totalServicePrice, $totalSparepartPrice, $subTotal = 0, $tax = 12000, $totalPrice = 0, $invoice, $invoiceId;
    protected $listeners = ['loadData', 'loadDataService', 'loadDataSparepart'];

    public $search = '', $searchService = '', $searchSparepart = '';
    public function render()
    {
        if ($this->ServiceOperationalId) {

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
        } else if ($this->invoice) {
            $data = ServiceOperational::where('id', $this->invoiceId)->first();

            return view('livewire.pages.admin.masterdata.operational.invoice-service', [
                'data' => $data,

            ]);
        } else {
            return view('livewire.pages.admin.masterdata.operational.index', [
                'data' => ServiceOperational::when($this->search, function ($query) {
                    $query->where('code', 'like', '%' . $this->search . '%');
                })->paginate(10),
            ]);
        }
    }

    public function invoiceService($id)
    {
        $this->invoiceId = $id;
        $this->invoice = true;
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

            $this->totalServicePrice = array_sum(array_column($this->serviceAdd, 'price'));
            $this->subTotal = $this->totalServicePrice + $this->totalSparepartPrice;
            $this->totalPrice = $this->subTotal + $this->tax;
        } else {
            $this->dispatch('error', 'Service not found.');
        }
    }

    public function addQty($id)
    {
        foreach ($this->sparepartAdd as &$sparepart) {
            if ($sparepart['id'] === $id) {
                $sparepart['qty'] += 1;
                $sparepart['price'] = $sparepart['qty'] * \App\Models\SparePart::find($id)->price;
                $this->updateTotalSparepartPrice();
                return;
            }
        }
        $this->dispatch('error', 'Spare part not found in the list.');
    }

    public function minQty($id)
    {
        foreach ($this->sparepartAdd as $key => &$sparepart) {
            if ($sparepart['id'] === $id) {
                if ($sparepart['qty'] > 1) {
                    $sparepart['qty'] -= 1;
                    $sparepart['price'] = $sparepart['qty'] * \App\Models\SparePart::find($id)->price;
                } else {
                    unset($this->sparepartAdd[$key]);
                }
                $this->updateTotalSparepartPrice();
                return;
            }
        }
        $this->dispatch('error', 'Spare part not found in the list.');
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
                    $this->updateTotalSparepartPrice();
                    return;
                }
            }
            $this->sparepartAdd[] = [
                'id' => $sparepartData->id,
                'name' => $sparepartData->name,
                'brand' => $sparepartData->brand,
                'stock' => $sparepartData->stock,
                'price' => $sparepartData->price * 1,
                'qty' => 1,
            ];

            $this->updateTotalSparepartPrice();
        } else {
            $this->dispatch('error', 'Spare part not found.');
        }
    }

    private function updateTotalSparepartPrice()
    {
        $this->totalSparepartPrice = array_sum(array_map(function ($sparepart) {
            return $sparepart['price'];
        }, $this->sparepartAdd));
        $this->subTotal = $this->totalServicePrice + $this->totalSparepartPrice;
        $this->totalPrice = $this->subTotal + $this->tax;
    }

    public function printBill()
    {

        // Pastikan transaksi memiliki ID ServiceOperational yang valid
        if (!$this->ServiceOperationalId) {
            $this->dispatch('error', 'Service Operational ID is required.');
            return;
        }

        $serviceOperational = ServiceOperational::find($this->ServiceOperationalId);

        if (!$serviceOperational) {
            $this->dispatch('error', 'Service Operational not found.');
            return;
        }

        // Simpan layanan (services) yang ditambahkan ke dalam tabel pivot
        foreach ($this->serviceAdd as $service) {
            $serviceOperational->services()->attach($service['id'], ['price' => $service['price']]);
        }

        // Simpan suku cadang (spareparts) yang ditambahkan ke dalam tabel pivot
        foreach ($this->sparepartAdd as $sparepart) {
            $serviceOperational->spareparts()->attach($sparepart['id'], [
                'quantity' => $sparepart['qty'],
                'price' => $sparepart['price']
            ]);
        }

        // Perbarui status transaksi menjadi "Completed" atau sesuai dengan kebutuhan
        $serviceOperational->update(['status' => 1]);

        // Reset data setelah transaksi selesai
        $this->serviceAdd = [];
        $this->sparepartAdd = [];
        $this->totalServicePrice = 0;
        $this->totalSparepartPrice = 0;
        $this->subTotal = 0;
        $this->totalPrice = 0;

        // Kirim notifikasi bahwa transaksi berhasil
        $this->dispatch('success', 'Transaction saved successfully.');
        $this->invoiceId = $serviceOperational->id;
        $this->ServiceOperationalId = null;
        $this->invoice = true;

        // Bisa ditambahkan kode untuk mencetak struk atau mengarahkan ke halaman cetak
    }
}
