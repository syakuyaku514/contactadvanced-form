<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
    Route::get('/mypage', [AuthController::class,'mypage']);
    Route::get('/done', [AuthController::class,'done']);
});

Route::get('/detail', [AuthController::class,'detail']);

Route::get('/thanks', [AuthController::class, 'thanks'])->middleware('auth');
