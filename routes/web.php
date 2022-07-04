<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GetPDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GetExcelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\RequestBarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landingpage.index');
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/denied', function () {
    return view('denied');
});

Route::middleware('auth','cekstatus')->group(function(){
    Route::middleware('cekadmin')->group(function(){
        Route::resource('/kategori',KategoriController::class);
        Route::resource('/barang',BarangController::class);
        Route::resource('/supplier',SupplierController::class);
        Route::resource('/user',UserController::class);
        Route::resource('/barang-masuk',BarangMasukController::class);
        Route::resource('/req-barang',RequestBarangController::class);
        Route::post('/tolak-req',[RequestBarangController::class,'tolak']);
        Route::post('/terima-req',[RequestBarangController::class,'terima']);
    });
    Route::post('/tambah-req',[RequestBarangController::class,'store']);
    Route::get('/dashboard',[DashboardController::class,'index'])->name('home');
    Route::resource('/profile',ProfileController::class);
    Route::get('/list-barang', [BarangController::class,'listBarang']);
    Route::post('/list-barang', [BarangController::class,'search']);
});

Route::get('/pdf-barang-masuk',[GetPDFController::class,'barangMasuk']);
Route::get('/excel-barang-masuk',[GetExcelController::class,'barangMasuk']);

Auth::routes();

