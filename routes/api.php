<?php

use App\Http\Controllers\Api\VisitController;
use Illuminate\Support\Facades\Route;

// Jalur API Akses Aplikasi Sales Lapangan Dewi Kartini CRM
Route::post('/visit/check-in', [VisitController::class, 'checkIn']);
Route::post('/visit/check-out/{id}', [VisitController::class, 'checkOut']);