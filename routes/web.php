<?php

use App\Http\Controllers\admin;
use App\Http\Controllers\paket;
use App\Http\Controllers\member;
use App\Http\Controllers\outlet;
use App\Http\Controllers\transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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
Route::get('/', [App\Http\Controllers\Auth\LoginController::class ,'showLoginForm']);
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class ,'showLoginForm']);
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'cek_role:admin']], function() {
    Route::resource('outlet', outlet::class);
    Route::resource('paket', paket::class);
    Route::resource('member', member::class);
    Route::resource('transaksi', transaksi::class);
    Route::put('transaksi_status/{id}', [transaksi::class, 'status'])->name('transaksi.status');
    Route::put('transaksi_dibayar/{id}', [transaksi::class, 'dibayar'])->name('transaksi.dibayar');
    Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::get('/user', [admin::class, 'index'])->name('user.index');
    Route::get('{id}/edit', [admin::class, 'edit'])->name('user.edit');
    Route::put('edit/{id}', [admin::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [admin::class, 'destroy'])->name('user.delete');
    Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class,'register']);
    Route::get('/laporan', [HomeController::class, 'laporan'])->name('home.laporan');
});

Route::group(['prefix' => 'kasir', 'middleware' => ['auth', 'cek_role:kasir']], function() {
    Route::resource('pelanggan', member::class);
    Route::resource('transaksi_kasir', transaksi::class);
    Route::put('transaksi_status/{id}', [transaksi::class, 'status'])->name('transaksi_kasir.status');
    Route::put('transaksi_dibayar/{id}', [transaksi::class, 'dibayar'])->name('transaksi_kasir.dibayar');
});

Route::group(['middleware' => 'auth'],function(){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('/laporan', [HomeController::class, 'laporan'])->name('home.laporan');
});
