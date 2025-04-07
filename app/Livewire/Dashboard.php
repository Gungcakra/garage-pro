<?php

namespace App\Livewire;

use App\Models\Menu;
use Livewire\Component;
use App\Models\ServiceOperational;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')] 
class Dashboard extends Component
{
    public $startDate, $endDate, $thisMonthIncome, $thisMonthServices, $incomePerformance;
        
    protected $listeners = ['loadData'];
    public function mount()
    {
        $this->thisMonthIncome = ServiceOperational::with(['services', 'spareparts'])
            ->where('status', 1)
            ->whereMonth('created_at', now()->month)
            ->get()
            ->reduce(function ($carry, $item) {
            $serviceIncome = $item->services->sum('pivot.price');
            $sparepartIncome = $item->spareparts->sum('pivot.price');
            return $carry + $serviceIncome + $sparepartIncome;
            }, 0);
        $this->thisMonthServices = ServiceOperational::with(['services', 'spareparts'])
            ->where('status', 1)
            ->whereMonth('created_at', now()->month)
            ->count();
        
        $this->startDate = $this->startDate ?? now()->startOfMonth();
        $this->endDate = $this->endDate ?? now();

        
        $this->incomePerformance = ServiceOperational::with(['services', 'spareparts'])
            ->where('status', 1)
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d H:00'); 
            })
            ->map(function ($group) {
                return $group->reduce(function ($carry, $item) {
                    $serviceIncome = $item->services->sum('pivot.price');
                    $sparepartIncome = $item->spareparts->sum('pivot.price');
                    return $carry + $serviceIncome + $sparepartIncome;
                }, 0);
            });
    }

    public function render()
    {
        
        $data = ServiceOperational::with(['services', 'spareparts'])
            ->where('status', 1)
            ->whereBetween('created_at', [$this->startDate, $this->endDate])
            ->get();

        return view('livewire.pages.admin.dashboard')->with([
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'menus' => Menu::with('submenus')->get(),
            'thisMonthIncome' => $this->thisMonthIncome,
            'thisMonthService' => $this->thisMonthServices,
            'incomeChart' => $this->incomePerformance->map(function ($value, $key) {
                return [
                    'hour' => $key, 
                    'income' => $value,
                ];
            })->values(), 
        ]);
    }

    public function loadData($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;

        
    }
}
