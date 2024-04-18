<?php


use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['middleware' => ['auth'], 'as'=>'dashboard.' , 'prefix'=>'dashboard' ], function () {
    // Routes inside the group
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
});





