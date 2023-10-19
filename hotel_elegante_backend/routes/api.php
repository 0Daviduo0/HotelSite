<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\TestController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BraintreeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/test', [TestController::class, 'test']);

Route::resource('rooms', RoomController::class);

Route::get('/braintree/token', [BraintreeController::class, 'getToken']);
Route::post('/braintree/make-payment', [BraintreeController::class, 'makePayment']);




