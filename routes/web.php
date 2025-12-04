<?php

use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VisitorController::class, 'create'])->name('visitors.create');
Route::post('/register', [VisitorController::class, 'store'])->name('visitors.store');

// Route baru untuk halaman sukses/notifikasi
Route::get('/success/{id}', [VisitorController::class, 'showSuccess'])->name('visitors.success');

// Route list pengunjung (tempat filter dan sorting berada)
Route::get('/list', [VisitorController::class, 'index'])->name('visitors.list');

// Route baru untuk Recap Bulanan (Export CSV)
Route::get('/recap-bulanan', [VisitorController::class, 'exportRecap'])->name('visitors.recap');