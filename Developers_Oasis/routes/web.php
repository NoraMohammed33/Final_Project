<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;


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
Route::get('/posts', function () {return view('posts');});
Route::get('/services', function () {return view('services');});

//Route::view('/admin/login','auth.loginAdmin');

Route::get('/departments', function () {return view('departments');});

// Admin login route
Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', function () {return view('homeAdmin');});


//expert
Route::get('/experts', function () {return view('expert');});
Route::get('/addexpert', function () {return view('addexpert');});
Route::get('/expert/{id}', function ($id) {
    return view('expertdetail', ['id' => $id]);
});
