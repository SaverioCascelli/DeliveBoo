<?php

use App\Http\Controllers\Api\RestaurantController;
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


Route::namespace('Api')
    ->prefix('restaurants')
    ->group(function () {
        Route::get('/', [RestaurantController::class, 'index']);
        Route::get('/search', [RestaurantController::class, 'searchByTypeAndName']);
        Route::get('/show', [RestaurantController::class, 'getRestaurant']);
        Route::get('/types', [RestaurantController::class, 'getTypes']);
        //Route::get('/restaurant-type/{typeIds}',[RestaurantController::class, 'getByType']);
    });

