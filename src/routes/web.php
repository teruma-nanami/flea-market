<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Controllers\PasswordResetLinkController;
use Laravel\Fortify\Http\Controllers\NewPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;

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

Fortify::verifyEmailView(function () {
	return view('auth.verify-email');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
	$request->fulfill();
	return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
	$request->user()->sendEmailVerificationNotification();
	return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/item/{id}', [HomeController::class, 'show'])->name('item.show');
Route::get('/purchase/thanks', [ItemController::class, 'thanks'])->name('purchase.thanks');
Route::get('/items/completed', [ItemController::class, 'completed'])->name('items.completed');

// ログアウト
Route::post('/logout', function () {
	Auth::logout();
	return redirect('/login');
})->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {
	Route::get('/profile/', [HomeController::class, 'profileShow'])->name('profile.show');
	Route::patch('/profile/update', [HomeController::class, 'profileUpdate'])->name('profile.update');
	Route::get('/item', [ItemController::class, 'index'])->name('home');
	Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
	Route::post('/items', [ItemController::class, 'store'])->name('items.store');
	Route::get('/purchase/{id}', [ItemController::class, 'show'])->name('purchase.show');
	Route::post('/purchase/{id}', [ItemController::class, 'purchace'])->name('purchase.store');
	Route::get('/mypage', [HomeController::class, 'mypage'])->name('profile.mypage');
	Route::get('/address/edit/{id}', [HomeController::class, 'addressEdit'])->name('address.edit');
	Route::patch('/address/update/{id}', [HomeController::class, 'addressUpdate'])->name('address.update');
});
