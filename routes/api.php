<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
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

Route::group(['prefix' => 'category'], function()
{
    Route::get('/', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
});

Route::group(['prefix' => 'task'], function()
{
    Route::get('/', [TaskController::class, 'index'])->name('task.index');
    Route::get('/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::post('/', [TaskController::class, 'store'])->name('task.store');
    Route::put('/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
});
