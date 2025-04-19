<?php

namespace App\Livewire;

use App\Models\Bank;
use App\Models\Cashflow as ModelsCashflow;
use App\Models\ServiceOperational;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Cashflow extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['loadData','deleteCashflowConfirmed','removeInvoice'];
    public $bank_id, $amount, $description, $type, $search = '', $bankIdSearch, $startDate, $endDate, $cashflowId, $selectedBank, $idToDelete, $invoice = false, $invoiceId, $dataUri, $tax = 12000;

    public function openModal()
    {
        $this->dispatch('show-modal');
    }

    public function closeModal()
    {
        $this->dispatch('close-modal');
        $this->reset(['bank_id', 'amount', 'description', 'type', 'cashflowId', 'selectedBank']);
    }

    public function create()
    {
        $this->openModal();
    }
    public function store()
    {
        $this->validate([
            'bank_id' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required|string|max:255',
            'type' => 'required',
        ]);

        $this->selectedBank = Bank::find($this->bank_id);
        if ($this->selectedBank->amount < $this->amount && (int)$this->type === 0) {
            $this->dispatch('error', 'Insufficient balance in the selected bank.');
            return;
        }
        ModelsCashflow::create([
            'bank_id' => $this->bank_id,
            'amount' => $this->amount,
            'description' => $this->description,
            'type' => $this->type,
        ]);
        if((int)$this->type === 0){
            $updateBalance = $this->selectedBank->amount - $this->amount;
            $this->selectedBank->update(['amount' => $updateBalance]);
        }else{
            $updateBalance = $this->selectedBank->amount + $this->amount;
            $this->selectedBank->update(['amount' => $updateBalance]);
        }
        $this->dispatch('success', 'Cashflow created successfully.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $this->idToDelete = $id;
        $this->dispatch('confirm-delete', 'Are you sure you want to delete this cashflow?');
    }
    public function deleteCashflowConfirmed()
    {
        $cashflow = ModelsCashflow::find($this->idToDelete);
        if ($cashflow) {
            $bank = Bank::find($cashflow->bank_id);
            if ((int)$cashflow->type === 0) {
                $updateBalance = $bank->amount + $cashflow->amount;
                $bank->update(['amount' => $updateBalance]);
            } else {
                $updateBalance = $bank->amount - $cashflow->amount;
                $bank->update(['amount' => $updateBalance]);
            }
            $cashflow->delete();
            $this->dispatch('delete-success', 'Cashflow deleted successfully.');
        }
    }
    public function mount()
    {
        $userPermissions = Auth::user()->roles->flatMap(function ($role) {
            return $role->permissions->pluck('name');
        });
    
        if (!$userPermissions->contains('operational-cashflow')) {
            abort(403, 'Unauthorized action.');
        }
    }
    public function loadData($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function detail($id)
    {
        $this->cashflowId = $id;
        $cashflowData = ModelsCashflow::find($this->cashflowId);
        $this->fill([
            'bank_id' => $cashflowData->bank_id,
            'amount' => $cashflowData->amount,
            'description' => $cashflowData->description,
            'type' => $cashflowData->type,
        ]);
        $this->dispatch('show-modal');
    }

    public function serviceDetail($code)
    {
        $invoiceCode = '#' . $code;
        $this->invoice = ServiceOperational::where('code', $invoiceCode)->first();
        $this->invoiceId = $this->invoice->id;
        $qrCode = new QrCode($invoiceCode);
        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $result = $writer->write($qrCode);
        $this->dataUri = $result->getDataUri();
        $this->invoice = true;
    }

    public function removeInvoice()
    {
        $this->invoiceId = null;
        $this->invoice = false;
    }   
    public function render()
    {
        if(!$this->invoice){
            return view('livewire.pages.admin.operational.cashflow.index',[
                'data' => ModelsCashflow::when($this->search, function ($query) {
                    $query->where('description', 'like', '%' . $this->search . '%');
                })
                ->when($this->bankIdSearch, function ($query) {
                    $query->where('bank_id', $this->bankIdSearch);
                })
                ->when($this->startDate, function ($query) {
                    $query->whereDate('created_at', '>=', $this->startDate);
                })
                ->when($this->endDate, function ($query) {
                    $query->whereDate('created_at', '<=', $this->endDate);
                })
                ->orderBy('created_at', 'asc')
                ->paginate(10),
                'banks' => Bank::all(),
            ]);
        }else{
            $data = ServiceOperational::where('id', $this->invoiceId)->first();

            return view('livewire.pages.admin.masterdata.operational.invoice-service', [
                'data' => $data,

            ]);
        }
    }
}
