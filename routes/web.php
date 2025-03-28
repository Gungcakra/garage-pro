<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\EmployeeManagement;
use App\Livewire\Auth\Login;
use App\Livewire\Customer;
use App\Livewire\Dashboard;
use App\Livewire\MenuManagement;
use App\Livewire\Service;
use App\Livewire\ServiceOperational;
use App\Livewire\Sparepart as LivewireSparepart;
use Illuminate\Support\Facades\Route;

Route::get('/login', Login::class)->name('login');
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/customer', Customer::class)->name('customer');
    Route::get('/employee', EmployeeManagement::class)->name('employee');
    Route::get('/menu', MenuManagement::class)->name('menu');
    Route::get('/service', Service::class)->name('service');
    Route::get('/sparepart', LivewireSparepart::class)->name('sparepart');
    Route::get('/serviceoperational', ServiceOperational::class)->name('serviceoperational');
    Route::get('/serviceinvoice/{id}', [ServiceOperational::class, 'getInvoice'])->name('serviceinvoice');
    Route::get('/test', MenuManagement::class)->name('test');
});