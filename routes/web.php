<?php

use App\Models\Kendaraan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GpsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RuteController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TestRuteController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\PengirimanController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them 
| will be assigned to the "web" middleware group.
| Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

// rute admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::controller(KendaraanController::class)->prefix('kendaraan')->group(function () {
        Route::get('', 'index')->name('kendaraan.index');
        Route::get('create', 'create')->name('kendaraan.create');
        Route::post('store', 'store')->name('kendaraan.store');
        Route::get('show/{id}', 'show')->name('kendaraan.show');
        Route::get('edit/{id}', 'edit')->name('kendaraan.edit');
        Route::put('edit/{id}', 'update')->name('kendaraan.update');
        Route::delete('destroy/{id}', 'destroy')->name('kendaraan.destroy');
    });

    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    
    Route::resource('rute', RuteController::class);
    Route::resource('gps', GpsController::class);


    //kebutuhan untuk tracking
    Route::get('maps/{id}', [TestRuteController::class, 'index'])->name('test-rute.index');
    Route::post('pengiriman/{id}/selesai', [PengirimanController::class, 'selesai'])->name('pengiriman.selesai');
    //kebutuhan untuk tracking Selesai

    //laporan
    Route::get('laporan/pengiriman', [LaporanController::class, 'index'])->name('laporan.pengiriman');
    Route::get('laporan/export', [LaporanController::class, 'exportToPDF'])->name('laporan.export');
    //laporan selesai

    Route::middleware(['role:admin'])->group(function () {
        Route::resource('pengiriman', PengirimanController::class);
        
        Route::prefix('admin')->group(function () {
            Route::get('/monitoring', [MonitoringController::class, 'index'])->name('admin.monitoring');
            Route::get('/test-rute', [App\Http\Controllers\TestRuteController::class, 'index'])->name('admin.test-rute');
        });
    });
    


    
});


