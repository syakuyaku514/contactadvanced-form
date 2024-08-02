<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\StoreReviewController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

// メール認証
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/profile', function () {
    // 確認済みのユーザーのみがこのルートにアクセス可能
})->middleware('verified');



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
    Route::get('/edit/{id}',[MypageController::class,'edit'])->name('edit');
    Route::post('/update/{id}',[MypageController::class,'update'])->name('update');

    Route::post('store/{store}/favorite',[FavoriteController::class, 'toggleFavorite'])->name('store.favorite');

    Route::post('/review/{id}', [StoreReviewController::class, 'storeReview'])->name('store.review');
    Route::delete('/review/{id}', [StoreReviewController::class, 'destroy'])->name('review.destroy');
    Route::patch('/review/{id}', [StoreReviewController::class, 'update'])->name('review.update');
    
});

// ゲスト
Route::get('/', [StoreController::class, 'index']);
Route::get('/store/{id}', [StoreController::class, 'detail'])->name('store.detail');
Route::get('/search',[StoreController::class, 'search']);
Route::post('/search',[StoreController::class, 'search'])->name('search');

Route::get('/review/{id}', [StoreReviewController::class, 'review'])->name('review');
