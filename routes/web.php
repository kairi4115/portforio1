<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TopController;
use Illuminate\Support\Facades\App;

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


Auth::routes();

Route::resource('category', CategoryController::class);
Route::resource('product', productController::class);
Route::get('/', [ProductController::class, 'productTop']);
Route::get('product/{id}',[ProductController::class, 'show']);

Route::get('top',[TopController::class, 'index']);
Route::get('top{id}',[TopController::class, 'show'])->name('top.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
