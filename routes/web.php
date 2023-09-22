<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\Auth\EmailVerificationController;
 
Route::controller(EmailVerificationController::class)
    ->prefix('email')->name('verification.')->group(function () {
        // 確認メール送信画面
        Route::get('verify', 'index')->name('notice');
        // 確認メール送信
        Route::post('verification-notification', 'notification')
            ->middleware('throttle:6,1')->name('send');
        // 確認メールリンクの検証
        Route::get('verification/{id}/{hash}', 'verification')
            ->middleware(['signed', 'throttle:6,1'])->name('verify');
    });
    
    