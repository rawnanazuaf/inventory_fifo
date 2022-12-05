<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\LedgerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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
    return view('authentication.login');
});
Route::get('/registerUser', function () {
    return view('authentication.register');
});

Route::middleware(['auth'])->group(function(){
    //product
    Route::get('/product',[ProductController::class,'index'])->name('product.index');
    Route::post('/product/create',[ProductController::class,'create'])->name('product.create');
    Route::post('/product/{id}/edit',[ProductController::class,'edit'])->name('product.edit');
    Route::get('/product/{id}/delete',[ProductController::class,'delete'])->name('product.delete');

    //transaksi
    Route::get('/transaksi',[TransaksiController::class,'index'])->name('transaksi.index');
    Route::post('/transaksi/createPembelianPersediaan',[TransaksiController::class,'createPembelianPersediaan'])->name('transaksi.createPembelianPersediaan');
    Route::post('/transaksi/createPenjualan',[TransaksiController::class,'createPenjualan'])->name('transaksi.createPenjualan');
    Route::post('/transaksi/{id}/edit',[TransaksiController::class,'edit'])->name('transaksi.edit');
    Route::get('/transaksi/{id}/delete',[TransaksiController::class,'delete'])->name('transaksi.delete');

    Route::get('/transaksi/id_product/{id}',[TransaksiController::class,'getProductDetail'])->name('transaksi.getProductDetail');
    Route::get('/transaksi/id_ledger/{id}',[TransaksiController::class,'getLedgerDetail'])->name('transaksi.getLedgerDetail');
    
    //ledger
    Route::get('/ledger',[LedgerController::class,'index'])->name('ledger.index');
    Route::post('/ledger/create',[LedgerController::class,'create'])->name('ledger.create');
    Route::post('/ledger/{id}/edit',[LedgerController::class,'edit'])->name('ledger.edit');
    Route::get('/ledger/{id}/delete',[LedgerController::class,'delete'])->name('ledger.delete');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
