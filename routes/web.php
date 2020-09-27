<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');

// Categories

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories')
    ->middleware(['auth:sanctum', 'verified']);

Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])
    ->name('categories.edit')
    ->middleware(['auth:sanctum', 'verified']);

Route::get('/categories/create', [CategoryController::class, 'create'])
    ->name('categories.create')
    ->middleware(['auth:sanctum', 'verified']);

Route::post('/categories/store', [CategoryController::class, 'store'])
    ->name('categories.store')
    ->middleware(['auth:sanctum', 'verified']);

Route::put('/categories/{category}', [CategoryController::class, 'update'])
    ->name('categories.update')
    ->middleware(['auth:sanctum', 'verified']);

Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
    ->name('categories.destroy')
    ->middleware(['auth:sanctum', 'verified']);