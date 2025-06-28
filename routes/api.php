<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\TestRuteController;
use App\Http\Controllers\Api\PengirimanController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/pengiriman', [PengirimanController::class, 'apiIndex']); 

Route::middleware('auth:sanctum')->get('/pengiriman/{id}', [PengirimanController::class, 'apiShow']); 
Route::middleware('auth:sanctum')->post('/pengiriman', [PengirimanController::class, 'apiStore']); 
Route::middleware('auth:sanctum')->put('/pengiriman/{id}', [PengirimanController::class, 'apiUpdate']); 
Route::middleware('auth:sanctum')->delete('/pengiriman/{id}', [PengirimanController::class, 'apiDestroy']); 

#dropdown pengriman buat ionic
Route::get('/kendaraan', [PengirimanController::class, 'getKendaraan']);
Route::get('/driver', [PengirimanController::class, 'getDriver']);
Route::get('/rute', [PengirimanController::class, 'getRute']);

// buat maps
Route::get('/rute/{id}', [TestRuteController::class, 'getRute']);
Route::get('/rute/default', [TestRuteController::class, 'getDefaultRute']);

//lokasi real driver
Route::post('/driver/{id}/update-location', [DriverController::class, 'updateLocation']);
//selseaikan pengriman
Route::post('pengiriman/{id}/selesai', [PengirimanController::class, 'apiSelesai']);