<?php

namespace App\Livewire;

use App\Models\Bank;
use App\Models\Cashflow as ModelsCashflow;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Cashflow extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['loadData','deleteCashflowConfirmed'];
    public $bank_id, $amount, $description, $type, $search = '', $bankIdSearch, $startDate, $endDate, $cashflowId, $selectedBank, $idToDelete;

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

        ModelsCashflow::create([
            'bank_id' => $this->bank_id,
            'amount' => $this->amount,
            'description' => $this->description,
            'type' => $this->type,
        ]);
        $this->selectedBank = Bank::find($this->bank_id);
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
    public function render()
    {
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
    }
}
