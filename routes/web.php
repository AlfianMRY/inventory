<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use GuzzleHttp\Middleware;
use PHPUnit\TextUI\XmlConfiguration\Group;

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

Route::get('/admin', function () {
    return view('layouts.master');
});

Route::middleware('auth')->group(function(){
    Route::resource('/kategori',KategoriController::class);
    Route::resource('/barang',BarangController::class);
    Route::resource('/supplier',SupplierController::class);
    Route::get('/dashboard',[DashboardController::class,'index'])->name('home');
});


Auth::routes();

