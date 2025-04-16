<?php

namespace App\Livewire;

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
    protected $listeners = ['loadData'];
    public $bank_id, $amount, $description, $type, $search = '', $bankIdSearch, $startDate, $endDate;

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
            'banks' => \App\Models\Bank::all(),
        ]);
    }
}
