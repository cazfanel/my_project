<?php

use Illuminate\Support\Facades\Route;
use Src\Infrastructure\Http\Controllers\EbookController;
use Src\Infrastructure\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ebooks', [EbookController::class, 'listAvailableEbooks']);
Route::post('/orders', [OrderController::class, 'createOrder']);

