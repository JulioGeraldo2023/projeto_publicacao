<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;

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

Route::get('/', [PublicationController::class, 'index']);
Route::get('/publications/create', [PublicationController::class, 'create'])->middleware('auth');
Route::get('/publications/{id}', [PublicationController::class, 'show']);
Route::post('/publications', [PublicationController::class, 'store']);
Route::delete('/publications/{id}', [PublicationController::class, 'destroy'])->middleware('auth');
Route::get('/publications/edit/{id}', [PublicationController::class, 'edit'])->middleware('auth');
Route::put('/publications/update/{id}', [PublicationController::class, 'update'])->middleware('auth');

Route::get('/dashboard', [PublicationController::class, 'dashboard'])->middleware('auth');

#Route::post('/publications/join/{id}', [PublicationController::class, 'joinPublication'])->middleware('auth'); ?
Route::get('/publications/join/{id}', [PublicationController::class, 'joinPublication'])->middleware('auth');

Route::delete('/publications/leave/{id}', [PublicationController::class, 'leavePublication'])->middleware('auth');
