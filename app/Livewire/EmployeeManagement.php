<?php

namespace App\Livewire;

use App\Events\DataUpdate;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Employee;
use Livewire\Attributes\Layout;

#[Layout('layouts.admin')]
class EmployeeManagement extends Component
{
    public $employeeId, $name, $position, $phone, $address;
    public $isModalOpen = false;
    #[On('echo:data-refresh,.table-employee')]
    public function render()
    {

        return view('livewire.pages.admin.employee', [
            'data' => Employee::get(),
        ]);
    }

    public function create()
    {
        $this->openModal();
    }
    public function openModal()
    {

        $this->isModalOpen = true;

    }
    public function closeModal()
    {
        $this->reset(['employeeId', 'name', 'position', 'phone', 'address']);
        $this->isModalOpen = false;
    }
    public function store()
    {
        Employee::create([
            'name' => $this->name,
            'position' => $this->position,
            'phone' => $this->phone,
            'address' => $this->address,
        ]);
        session()->flash('message', 'Employee added successfully.');
        DataUpdate::dispatch('table-employee');
        $this->closeModal();
   
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $this->employeeId = $employee->id;
        $this->name = $employee->name;
        $this->position = $employee->position;
        $this->phone = $employee->phone;
        $this->address = $employee->address;
        $this->openModal();
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
        session()->flash('message', 'Employee updated successfully.');
        DataUpdate::dispatch('table-employee');
        $this->closeModal();
    }
    public function submitForm()
    {
        if ($this->employeeId) {
            $this->update();
        } else {
            $this->store();
        }
    }
    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        session()->flash('message', 'Employee deleted successfully.');
        DataUpdate::dispatch('table-employee');

    }

}
