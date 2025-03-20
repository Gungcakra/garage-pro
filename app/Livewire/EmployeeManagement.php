<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\Layout; // Tambahkan ini

#[Layout('layouts.admin')] // Gunakan layout di Livewire 3
class EmployeeManagement extends Component
{
    public $employees, $name, $position, $phone, $address, $employeeId;
    public $modal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'address' => 'nullable|string'
    ];

    public function mount()
    {
        $this->employees = Employee::latest()->get();
    }

    public function render()
    {
        return view('livewire.pages.admin.employee')->with([
            'title' => 'Employee Management',
            'active' => 'employee',
            'data' => $this->employees,
        ]);;
    }
}
