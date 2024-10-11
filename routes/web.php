<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;

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

// Página de inicio del blog, muestra los artículos
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes();

// CRUD de posts, accesible solo para usuarios autenticados
Route::resource('posts', PostController::class)->middleware('auth');

