<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TimerController;

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
    return redirect('/data-order');
});
Route::get('/register', [RegisterController::class, 'viewRegister'])->name('register');
Route::post('/postRegister',[RegisterController::class, 'postRegister'])->name('postRegister');

Route::get('/login', [LoginController::class, 'viewLogin'])->name('login');
Route::post('/postLogin',[LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'checkLevel:admin,teknisi']], function(){
    Route::get('/data-order', [OrderController::class, 'index'])->name('data-order');
});

Route::group(['middleware' => ['auth', 'checkLevel:admin']], function(){
    Route::get('/data-order/create', [OrderController::class, 'create'])->name('create-order');
    Route::post('/store-order', [OrderController::class, 'store'])->name('store-order');

    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/schedule/{id}', [ScheduleController::class, 'chooseTeknisi'])->name('choose-teknisi');
    Route::get('/calendar/{teknisi}', [ScheduleController::class, 'calendar'])->name('calendar');
    Route::get('/schedule/{id}/{teknisi}', [ScheduleController::class, 'create'])->name('create-schedule');
    Route::post('/schedule', [ScheduleController::class, 'action']);
});

Route::group(['middleware' => ['auth', 'checkLevel:teknisi']], function(){
    Route::get('/timer', [TimerController::class, 'index'])->name('timer');
    Route::get('/timer/{id}', [TimerController::class, 'timer'])->name('timer-count');
});