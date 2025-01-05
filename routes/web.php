<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PelangganController;
use App\Http\Controllers\Admin\SupirController;
use App\Http\Controllers\Admin\MobilController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route group untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data Routes
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('supir', SupirController::class);
    Route::resource('mobil', MobilController::class);

    // Routes untuk pengiriman
    Route::get('/pengiriman', [App\Http\Controllers\Admin\PengirimanController::class, 'index'])->name('pengiriman.index');
    Route::get('/pengiriman/{pengiriman}', [App\Http\Controllers\Admin\PengirimanController::class, 'show'])->name('pengiriman.show');
    Route::post('/pengiriman/{pengiriman}/approve', [App\Http\Controllers\Admin\PengirimanController::class, 'approve'])->name('pengiriman.approve');
    Route::get('/pengiriman/{pengiriman}/reject', [App\Http\Controllers\Admin\PengirimanController::class, 'reject'])->name('pengiriman.reject');
});

// Route group untuk pelanggan
Route::middleware(['auth', 'role:pengguna'])->prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/dashboard', function () {
        return view('pelanggan.dashboard');
    })->name('dashboard');

    // Routes untuk pengiriman
    Route::resource('pengiriman', App\Http\Controllers\Pelanggan\PengirimanController::class);
});

// Route group untuk supir
Route::middleware(['auth', 'role:supir'])->prefix('supir')->name('supir.')->group(function () {
    Route::get('/dashboard', function () {
        return view('supir.dashboard');
    })->name('dashboard');

    // Routes untuk pengiriman
    Route::get('/pengiriman', [App\Http\Controllers\Supir\PengirimanController::class, 'index'])->name('pengiriman.index');
    Route::get('/pengiriman/{pengiriman}', [App\Http\Controllers\Supir\PengirimanController::class, 'show'])->name('pengiriman.show');
    Route::post('/pengiriman/{pengiriman}/update-status', [App\Http\Controllers\Supir\PengirimanController::class, 'updateStatus'])->name('pengiriman.updateStatus');
    Route::post('/pengiriman/{pengiriman}/update-lokasi', [App\Http\Controllers\Supir\PengirimanController::class, 'updateLokasi'])->name('pengiriman.updateLokasi');
});

require __DIR__.'/auth.php';
