<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

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



Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard', [
            'title' => 'Dashboard',
        ]);
    });
    Route::get('/user', [AuthController::class, 'index']);
    Route::get('/user/delete/{id}', [AuthController::class, 'destroy']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'createUser']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/product', ProductController::class);
    Route::resource('/transaction', TransactionController::class);
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'auth']);
});
