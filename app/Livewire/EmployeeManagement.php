<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')] // Gunakan layout admin
class EmployeeManagement extends Component
{
    public $name, $position, $phone, $address, $employeeId;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.pages.admin.employee', data: [
            'data' => Employee::latest()->get(),
        ]);
    }

    public function create()
    {
        $this->resetFields();
        $this->isEdit = false;
        $this->dispatch('show-employee-modal');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $this->employeeId = $id;
        $this->name = $employee->name;
        $this->position = $employee->position;
        $this->phone = $employee->phone;
        $this->address = $employee->address;
        $this->isEdit = true;
        $this->dispatch('show-employee-modal');

    }

    public function store()
    {
        Employee::create([
            'name' => $this->name,
            'position' => $this->position,
            'phone' => $this->phone,
            'address' => $this->address,
            ]);
            $this->dispatch('hide-employee-modal');
            $this->dispatch('success', 'Employee created successfully!');
            $this->resetFields();
    
    }

    public function update()
    {
        $employee = Employee::findOrFail($this->employeeId);
        $employee->update([
            'name' => $this->name,
            'position' => $this->position,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);

        $this->dispatch('hide-employee-modal');
        $this->dispatch('success', 'Employee updated successfully!');

    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        session()->flash('message', 'Employee deleted successfully!');
    }

    private function resetFields()
    {
        $this->name = '';
        $this->position = '';
        $this->phone = '';
        $this->address = '';
        $this->employeeId = null;
    }
}
