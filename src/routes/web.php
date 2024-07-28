<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;

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


// ログイン中
Route::middleware('auth')->group(function () {
    Route::get('/', [AuthController::class,'index']);
    Route::get('/thanks', [AuthController::class, 'thanks']);
    Route::get('/detail', [AuthController::class,'detail']);
    Route::get('/done', [AuthController::class,'done'])->name('done');

    Route::post('/store/{id}', [StoreController::class, 'create']);
    Route::get('/search',[StoreController::class, 'search']);
    Route::post('/search',[StoreController::class, 'search'])->name('search');

    Route::delete('reservations/{reservation}', [MypageController::class, 'destroy'])->name('reservation.destroy');
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::post('/reservations', [MypageController::class, 'store'])->name('reservation.store');

    Route::post('store/{store}/favorite',[FavoriteController::class, 'toggleFavorite'])->name('store.favorite');
    
});

// ゲスト
Route::get('/', [StoreController::class, 'index']);
Route::get('/store/{id}', [StoreController::class, 'detail'])->name('store.detail');
