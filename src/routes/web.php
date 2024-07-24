<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MypageController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class,'index']);
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::get('/done', [AuthController::class,'done'])->name('done');
    Route::get('/thanks', [AuthController::class, 'thanks']);
    Route::post('/store/{id}', [StoreController::class, 'create']);
    Route::get('/detail', [AuthController::class,'detail']);
    Route::delete('reservations/{reservation}', [MypageController::class, 'destroy'])->name('reservation.destroy');
    Route::post('/reservations', [MypageController::class, 'store'])->name('reservation.store');
    
});

Route::get('/', [StoreController::class, 'index']);
Route::get('/store/{id}', [StoreController::class, 'detail'])->name('store.detail');
