<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Cashflow extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.operational.cashflow.index');
    }
}
