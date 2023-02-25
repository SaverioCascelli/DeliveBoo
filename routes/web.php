<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Guest\BraintreeController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
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



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });



// Raggruppo tutte le rotte per la parte admin
// Accesso tramite autenticazione
Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        // rotta per la parte admin del sito
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('foods/orderby/{col}/{dir}', [FoodController::class, 'orderBy'])->name('foods.orderby');
        Route::get('foods/toggle-available/{id}', [FoodController::class, 'toggleAvailable'])->name('toggleavailable');
        Route::get('get-auth', [FoodController::class, 'getAuth'])->name('getAuth');
        Route::resource('foods', FoodController::class);
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/statistics', [OrderController::class, 'statistics'])->name('statistics');
    });

Route::any('/get-token', [BraintreeController::class, 'getToken']);
Route::any('/nounce', [BraintreeController::class, 'nounce']);


require __DIR__ . '/auth.php';


/************************************************************/
/********************* ROTTE LATO CLIENT ********************/
/************************************************************/

// questa è la rotta per la home della parte guest del sito
Route::any('/', [PageController::class, 'index'])->name('home');

// rotta per tutte le rotte Vue da mettere doppo tutte le altre rotte!
Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*')->name('home');
