<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::get('/', ProductController::class, 'index');
Route::get('/', [ProductController::class, 'index']);
Route::get('/home', [ProductController::class, 'home'])->name('product.home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::post('/', [ProductController::class, 'store'])->name('product.store');