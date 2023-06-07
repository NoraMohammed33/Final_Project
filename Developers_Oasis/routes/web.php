<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('/', function () {return view('welcome');});

//=====================contracts routes ======================
Route::resource('contracts',ContractController::class);

//=====================services routes ======================
Route::resource('services',ServiceController::class);


//=====================posts routes==========================
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store']);
Route::get('/posts/{post}', [PostController::class, 'show']);
Route::get('/posts/{post}/edit', [PostController::class, 'edit']);
Route::put('/posts/{post}', [PostController::class, 'update']);
Route::delete('/posts/{post}', [PostController::class, 'destroy']);

//========================comments routes===========================

use App\Http\Controllers\CommentController;

Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
Route::get('/posts/{post}/comments/{comment}', [CommentController::class, 'destroy']);
Route::put('/posts/{post}/comments/{comment}', [CommentController::class, 'update']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

