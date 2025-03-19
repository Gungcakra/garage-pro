<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\EmployeeManagement;
use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;


Route::get('/login', Login::class)->name('login');

Route::get('/dashboard', function () {
    return view('pages.admin.index', [
        'title' => 'Dashboard',
        'active' => 'dashboard',
    ]);
})->name('dashboard')->middleware('auth');
Route::get('/employee',EmployeeManagement::class)->name('employee');