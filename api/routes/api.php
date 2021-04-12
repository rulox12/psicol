<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware('auth:api')->group(function () {

    //Routes buyer
    Route::get('buyer', [BuyerController::class, 'all']);
    Route::post('buyer', [BuyerController::class, 'store']);

    //Routes ticket
    Route::get('ticket', [TicketController::class, 'all']);
    Route::post('ticket', [TicketController::class, 'store']);

});
