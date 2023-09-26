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
    
use App\Http\Controllers\Admin\NewsController;
Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->middleware('verified')->group(function () {
    Route::get('vaccination/create', 'add')->name('vaccination.add');
    Route::post('vaccination/create', 'create')->name('vaccination.create');
    Route::get('vaccination', 'index')->name('vaccination.index');
    Route::get('vaccination/edit', 'edit')->name('vaccination.edit');
    Route::post('vaccination/edit', 'update')->name('vaccination.update');
    Route::get('vaccination/delete', 'delete')->name('vaccination.delete');
});

use App\Http\Controllers\Admin\ProfileController;
Route::controller(ProfileController::class)->prefix('admin')->name('admin.')->middleware('auth')->middleware('verified')->group(function() {
    Route::get('profile/create', 'add')->name('profile.add');
    Route::get('profile/edit', 'edit')->name('profile.edit');
    Route::post('profile/create', 'create')->name('profile.create');
    Route::post('profile/edit', 'update')->name('profile.update');
});


