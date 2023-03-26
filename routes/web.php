<?php

use Illuminate\Support\Facades\Route;

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


Route::middleware(['isAuth'])->group(function(){
    Route::get('/Favorite',[\App\Http\Controllers\FavoritesController::class,'index'])->name('Favorite-index');
    Route::post('/Favorite',[\App\Http\Controllers\FavoritesController::class,'store'])->name('Favorite-store');
    Route::delete('/Favorite/{symbol}',[\App\Http\Controllers\FavoritesController::class,'destroy'])->name('Favorite-destroy');
});

Route::get('/',[\App\Http\Controllers\HomeController::class,'index'])->name('Home-index');
Route::get('/Auth',[\App\Http\Controllers\AuthController::class,'LoginUser'])->name('Auth-LoginUser');
Route::get('/{id}',[\App\Http\Controllers\DetailsController::class,'index'])->name('Details-index');

