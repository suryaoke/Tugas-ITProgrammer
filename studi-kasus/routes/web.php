<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemeriksaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueryController;
use Illuminate\Support\Facades\Route;

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

require __DIR__ . '/auth.php';


// route admin //

Route::group(
    [
        "middleware" => "auth",
        "verified",
        "role:admin",
        "prefix" => "admin",
        "as" => "admin."
    ],
    function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('pelanggan', PelangganController::class);

        Route::resource('obat', ObatController::class);

        Route::resource('dokter', DokterController::class);

        Route::resource('pemeriksaan', PemeriksaanController::class);

        Route::post('pemeriksaan/store-detail', [PemeriksaanController::class, 'storeDetail'])
            ->name('pemeriksaan.storeDetail');

        Route::get('pemeriksaan/deleteDetail/{index}', [PemeriksaanController::class, 'deleteDetail'])
            ->name('pemeriksaan.deleteDetail');

        Route::get('pemeriksaan/detail/{pemeriksaan}', [PemeriksaanController::class, 'detail'])
            ->name('pemeriksaan.detail');
    }
);


// route query

Route::get('/query1', [QueryController::class, 'query1']);
Route::get('/query2', [QueryController::class, 'query2']);
Route::get('/query3', [QueryController::class, 'query3']);
Route::get('/query4', [QueryController::class, 'query4']);
Route::get('/query5', [QueryController::class, 'query5']);
