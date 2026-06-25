<?php

use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;

// Rute Navigasi Dashboard AdminLTE Dewi Kartini CRM
Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/stores', [AdminDashboardController::class, 'stores'])->name('admin.stores');
Route::get('/admin/marketing', [AdminDashboardController::class, 'marketing'])->name('admin.marketing');
Route::get('/admin/stocks', [AdminDashboardController::class, 'stocks'])->name('admin.stocks');