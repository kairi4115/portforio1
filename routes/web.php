<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TopController;
use App\Http\Controllers\RecipeStepController;
use App\Http\Controllers\TwitterController;
use App\Models\RecipeStep;
use Illuminate\Support\Facades\App;
use Abraham\TwitterOAuth\TwitterOAuth;


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

Route::resource('category', CategoryController::class)->middleware('auth');
Route::resource('product', productController::class)->middleware('auth');
//Route::get('product/create',[ProductController::class]);
Route::get('/', [ProductController::class, 'productTop']);
Route::get('product/{id}',[ProductController::class, 'show']);


Route::get('top',[TopController::class, 'index'])->middleware('auth');
Route::get('top/{id}',[TopController::class, 'show'])->name('top.show')->middleware('auth');
//Route::get('top/{product}',[TopController::class, 'store'])->name('top.store');
Route::post('top/{product}', [TopController::class, 'store'])->name('top.store');
Route::get('top/{product}/edit', [TopController::class, 'edit'])->name('top.edit');
Route::put('top/steps/updateAll/{product}', [TopController::class, 'updateAll'])->name('top.updateAll');
Route::delete('top/steps/{step}', [TopController::class, 'destroy'])->name('top.steps.destroy');
Route::get('/recipes/{product}', [RecipeStepController::class, 'store'])->name('recipe.steps.store');
Route::post('/recipes/{product}', [RecipeStepController::class, 'store'])->name('recipe.steps.store');
Route::get('recipes/{product}edit', [RecipeStepController::class, 'edit'])->name('recipe.edit');
Route::post('/recipe/steps/{step}', [RecipeStepController::class, 'update'])->name('recipe.steps.update');

Route::get('/product/{id}/tweet', [TwitterController::class, 'tweetProduct'])->name('product.tweet');
Route::get('/tweet-product/{id}', [TwitterController::class, 'tweetProduct'])->name('tweet.product');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
