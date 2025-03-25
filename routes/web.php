<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\EmployeeManagement;
use App\Livewire\Auth\Login;
use App\Livewire\Customer;
use App\Livewire\Dashboard;
use App\Livewire\MenuManagement;
use Illuminate\Support\Facades\Route;


Route::get('/login', Login::class)->name('login');
Route::get('/logout', [Login::class, 'logout'])->name('logout');

Route::get('/dashboard',Dashboard::class)->name('dashboard');
Route::get('/customer',action: Customer::class)->name('customer');
Route::get('/employee',EmployeeManagement::class)->name('employee');
Route::get('/menu',MenuManagement::class)->name('menu');
Route::get('/test',action: MenuManagement::class)->name('test');