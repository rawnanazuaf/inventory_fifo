<?php

use App\Http\Controllers\ApplicationController;
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
    Route::get('/application',[ApplicationController::class,'index']);
    Route::post('/application/create',[ApplicationController::class,'create']);
    Route::post('/application/{id}/edit',[ApplicationController::class,'edit']);
    Route::get('/application/{id}/delete',[ApplicationController::class,'delete']);
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
