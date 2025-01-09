<?php

use App\Http\Controllers\AturanController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\KerusakanController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\SolusiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KelolaKonsultasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GejalaExcelController;



Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/konsultasi', [KonsultasiController::class, 'index'])->name('konsultasi');
Route::get('/informasi-data', [HomeController::class, 'informasi'])->name('informasi');
Route::get('/panduan', [HomeController::class, 'panduan'])->name('panduan');

Route::middleware(['auth'])->group(function () {
    Route::get('/konsultasi/form', [KonsultasiController::class, 'form'])->name('konsultasi.form');
    Route::post('/konsultasi/proses', [KonsultasiController::class, 'process'])->name('konsultasi.process');
    Route::delete('/konsultasi/hapus/{id}', [KonsultasiController::class, 'destroy'])->name('konsultasi.hapus');
});

Route::get('/konsultasi/hasil/{id}',  [KonsultasiController::class, 'hasil'])->name('konsultasi.hasil');
Route::get('/konsultasi/{id}/download-pdf', [KonsultasiController::class, 'downloadPDF'])->name('konsultasi.downloadPDF');

// Admin Routes

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/gejala', GejalaController::class);
    Route::post('/gejala/clear', [GejalaController::class, 'clear'])->name('gejala.clear');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/kerusakan', KerusakanController::class);
    Route::post('/kerusakan/clear', [KerusakanController::class, 'clear'])->name('kerusakan.clear');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/solusi', SolusiController::class);
    Route::post('/solusi/clear', [SolusiController::class, 'clear'])->name('solusi.clear');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/users', UserController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('admin/kelola-konsultasi', KelolaKonsultasiController::class);
});


Route::get('/admin/aturan', [AturanController::class, 'index'])->name('aturan')->middleware('admin');
Route::get('/admin/aturan/create', [AturanController::class, 'create'])->name('aturan.create')->middleware('admin');
Route::get('/admin/edit/{id}', [AturanController::class, 'edit'])->name('aturan.edit')->middleware('admin');
Route::put('/admin/aturan/update', [AturanController::class, 'updateAturan'])->name('aturan.update')->middleware('admin');
Route::post('/admin/aturan/store', [AturanController::class, 'store'])->name('aturan.store')->middleware('admin');
Route::delete('/admin/aturan/delete/{id}', [AturanController::class, 'destroy'])->name('aturan.destroy')->middleware('admin');
Route::get('/admin', [AdminController::class, 'index'])->middleware('admin')->name('admin');
Route::post('/aturan/clear', [AturanController::class, 'clear'])->name('aturan.clear');


// ROUTE UNTUK IMPORT DAN EXPORT


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('gejala/export', [GejalaExcelController::class, 'export'])->name('gejala.export');
    Route::post('gejala/import', [GejalaExcelController::class, 'import'])->name('gejala.import');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/kerusakan/export', [KerusakanController::class, 'export'])->name('kerusakan.export');
    Route::post('/kerusakan/import', [KerusakanController::class, 'import'])->name('kerusakan.import');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/solusi/export', [SolusiController::class, 'export'])->name('solusi.export');
    Route::post('/solusi/import', [SolusiController::class, 'import'])->name('solusi.import');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/aturan/export', [AturanController::class, 'export'])->name('aturan.export');
    Route::post('/aturan/import', [AturanController::class, 'import'])->name('aturan.import');
});
