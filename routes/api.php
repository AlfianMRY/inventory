<?php

use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\BarangController;
use App\Http\Controllers\Api\v1\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    // Route Data Barang
    Route::get('/barang',[BarangController::class,'index']);
    Route::get('/barang/{id}',[BarangController::class,'show']);

    // Route Data Kategori
    Route::get('/kategori',[KategoriController::class,'index']);
    Route::post('/kategori',[KategoriController::class,'create']);
    Route::get('/kategori/{id}',[KategoriController::class,'show']);
    Route::put('/kategori/{id}',[KategoriController::class,'update']);
    Route::delete('/kategori/{id}',[KategoriController::class,'destroy']);
    
    // Log Out
    Route::post('logout',[AuthController::class,'logout']);
});


Route::post('login',[AuthController::class,'login']);