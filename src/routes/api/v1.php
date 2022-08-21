<?php

use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\StatisticController;
use App\Http\Controllers\Api\TripController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/{order}/report', [OrderController::class, 'report'])->name('orders.report');
    Route::post('/{order}/trip', [TripController::class, 'store'])->name('orders.trip.store');
});

Route::post('/agent/assign-report', [OrderController::class, 'assignToAgent'])->name('orders.assign');
Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics.index');
