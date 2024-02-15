<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::group(['prefix' => 'users', 'name' => 'users', 'as' => 'users.'], function () {

        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'] )->name('index');
        Route::get('/{type}', [\App\Http\Controllers\UserController::class, 'getUsersByType'] )->name('get-users-by-type');
        Route::post('/create', [\App\Http\Controllers\UserController::class, 'create'] )->name('create');
        Route::post('/{user_id}/update', [\App\Http\Controllers\UserController::class, 'update'] )->name('update');

    });

    Route::group(['prefix' => 'sucursales', 'name' => 'sucursales', 'as' => 'sucursales.'], function () {

        Route::get('/', [\App\Http\Controllers\SucursalController::class, 'index'] )->name('index');
        Route::post('/create', [\App\Http\Controllers\SucursalController::class, 'create'] )->name('create');
        Route::put('/{sucursal_id}/update', [\App\Http\Controllers\SucursalController::class, 'update'] )->name('update');


        Route::group(['prefix' => '{sucursal_id}/platillos', 'name' => 'platillos', 'as' => 'platillos.'], function () {

            Route::get('/', [\App\Http\Controllers\PlatilloController::class, 'index'] )->name('index');
            Route::post('/create', [\App\Http\Controllers\PlatilloController::class, 'store'] )->name('create');
            Route::post('/{platillo_id}/update', [\App\Http\Controllers\PlatilloController::class, 'update'] )->name('update');

        });

    });

    Route::group(['prefix' => 'sales', 'name' => 'sales', 'as' => 'sales.'], function () {
        Route::get('/', [\App\Http\Controllers\SalesController::class, 'index'] )->name('index');
        Route::post('/create', [\App\Http\Controllers\SalesController::class, 'store'] )->name('create');
        Route::put('/{sale_id}/update', [\App\Http\Controllers\SalesController::class, 'update'] )->name('update');

    });


});

require __DIR__ . '/auth.php';
