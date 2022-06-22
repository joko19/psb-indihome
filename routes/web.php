<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

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
Route::get('/register', [RegisterController::class, 'viewRegister'])->name('register');
Route::post('/postRegister',[RegisterController::class, 'postRegister'])->name('postRegister');

Route::get('/login', [LoginController::class, 'viewLogin'])->name('login');
Route::post('/postLogin',[LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['checkLevel:admin']], function(){
    Route::get('/beranda', function () {
        return view('beranda');
    });
    Route::get('/data-order', function () {
        return view('data-order');
    });
});

Route::group(['middleware' => ['checkLevel:teknisi']], function(){
    Route::get('/beranda', function () {
        return view('beranda');
    });
    Route::get('/data-order', function () {
        return view('data-order');
    });
});