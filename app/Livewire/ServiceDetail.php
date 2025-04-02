<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('layouts.admin')]
class ServiceDetail extends Component
{
    public function render()
    {
        return view('livewire.pages.admin.operational.service.service-detail');
    }
}
