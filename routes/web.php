<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\EmployeeManagement;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard;
use App\Livewire\MenuManagement;
use Illuminate\Support\Facades\Route;


Route::get('/login', Login::class)->name('login');

Route::get('/dashboard',Dashboard::class)->name('dashboard');
Route::get('/test',Dashboard::class)->name('test');
Route::get('/employee',EmployeeManagement::class)->name('employee');
Route::get('/menu',MenuManagement::class)->name('menu');