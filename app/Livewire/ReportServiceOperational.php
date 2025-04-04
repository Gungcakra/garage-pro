<?php

namespace App\Livewire;

use App\Models\ServiceOperational;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class ReportServiceOperational extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public $serviceOperational;
    public $startDate = '';
    public $endDate = '';
    public $status = '';
    public function render()
    {
        return view('livewire.pages.admin.report.service.index', [
            'data' => ServiceOperational::when($this->startDate || $this->endDate || $this->status, function ($query) {
            if ($this->startDate) {
                $query->where('created_at', '>=', $this->startDate);
            }
            if ($this->endDate) {
                $query->where('created_at', '<=', $this->endDate);
            }
            if ($this->status) {
                $query->where('status', $this->status);
            }
            }, function ($query) {
            // Default query when no filters are applied
            $query->orderBy('created_at', 'desc');
            })->paginate(10)
        
        ]);
    }
}
