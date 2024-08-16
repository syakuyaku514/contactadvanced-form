<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ReviewController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\StoreOwnerController;

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
Route::get('/test-error', function () {
    abort(500, 'Intentional Error for Testing');
});
// ユーザーがメールアドレスの確認を行うためのページを表示
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

// ユーザーがメールアドレスの確認を行うためのページを表示
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

// ユーザーが認証メールを再送信するためのリクエスト
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// 確認済みのユーザーのみがこのルートにアクセス可能
Route::get('/profile', function () {
    
})->middleware('verified');



// ログイン中
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/', [AuthController::class,'index']);
    Route::get('/thanks', [AuthController::class, 'thanks']);
    Route::get('/detail', [AuthController::class,'detail'])->name('detail');
    Route::get('/done', [AuthController::class,'done'])->name('done');

    // 店舗詳細
    Route::post('/store/{id}', [StoreController::class, 'create']);
    Route::get('/search',[StoreController::class, 'search']);
    Route::post('/search',[StoreController::class, 'search'])->name('search');
    Route::get('/store/{id}', [StoreController::class, 'detail'])->name('store.detail');

    // マイページ
    Route::delete('reservations/{reservation}', [MypageController::class, 'destroy'])->name('reservation.destroy');
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::post('/reservations', [MypageController::class, 'store'])->name('reservation.store');
    Route::get('/edit/{id}',[MypageController::class,'edit'])->name('edit');
    Route::post('/update/{id}',[MypageController::class,'update'])->name('update');
    Route::get('/checkin/{reservation_id}', [StoreController::class, 'checkin'])->name('checkin');

    // お気に入り機能
    Route::post('store/{store}/favorite',[FavoriteController::class, 'toggleFavorite'])->name('store.favorite');

    // レビュー
    Route::post('/review/{id}', [ReviewController::class, 'review'])->name('store.review');
    Route::delete('/review/{id}', [ReviewController::class, 'destroy'])->name('review.destroy');
    Route::patch('/review/{id}', [ReviewController::class, 'update'])->name('review.update');

    // 決済
    Route::post('/payment', [UserController::class, 'payment'])->name('payment');
    Route::get('/payment/{reservation}', [UserController::class, 'paymentPage'])->name('payment.page');
    Route::post('/payment/complete', [UserController::class, 'payment'])->name('payment.complete');
    Route::post('/payment/process', [UserController::class, 'payment'])->name('payment.process');
});

// ゲスト
Route::get('/', [StoreController::class, 'index']);
Route::get('/store/{id}', [StoreController::class, 'detail'])->name('store.detail');
Route::get('/search',[StoreController::class, 'search']);
Route::post('/search',[StoreController::class, 'search'])->name('search');

// レビュー画面
Route::get('/review/{id}', [ReviewController::class, 'review'])->name('review');


Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/store-owners', StoreOwnerController::class);
    // 管理者ログイン画面を表示するルート
    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    // 管理者登録画面を表示するルート
    Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');

    // 管理者画面を表示するルート
    Route::get('/admin/index', [AdminAuthController::class, 'index'])->name('admin.index');
});

Route::group(['middleware' => ['auth', 'role:store_owner']], function () {
    Route::get('/store-owner/dashboard', [StoreOwnerController::class, 'index'])->name('store_owner.dashboard');
    Route::resource('/store-owner/stores', StoreController::class);
    Route::get('/store-owner/reservations', [ReservationController::class, 'index'])->name('store_owner.reservations');
});

