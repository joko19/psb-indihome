<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post(
    '/postLogin', 
    [LoginController::class, 'postLogin']
)->name('postLogin');

Route::get(
    '/logout', 
    [LoginController::class, 'logout']
)->name('logout');

Route::group(['middleware' => ['checkLevel:teknisi']], function(){
    Route::get('/beranda', function () {
        return view('beranda');
    });
    Route::get('/data-order', function () {
        return view('data-order');
    });
});