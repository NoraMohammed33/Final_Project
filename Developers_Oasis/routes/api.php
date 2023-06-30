<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\ContractController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\ExpertController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\ServiceRatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return Auth::user();
});
//Route::post('/api/admin/login','AdminController@adminLogin');


Route::get('/paypal/payment', [PaymentController::class, 'createPayment']);
Route::get('/paypal/execute-payment', [PaymentController::class, 'successTransaction'])->name('execute');
Route::get('/success', function () {
    return view('welcome');
})->name('success');;
Route::get('/error', function () {
    return view('welcome');
})->name('error');;

//=====================contracts routes ======================
Route::apiResource('contracts',ContractController::class);

//=====================services routes ======================
Route::apiResource('services',ServiceController::class)->middleware('auth:sanctum');


//=====================posts routes==========================
Route::apiResource('posts',PostController::class)->middleware('auth:sanctum');
Route::get('/posts/{id}/explore', [PostController::class, 'explore']);

Route::apiResource('posts',PostController::class);

//========================comments routes==================

Route::apiResource('posts.comments',CommentController::class);
Route::get('/comments/{post}', [CommentController::class, 'commentsForPost']);

//==============experts====================================

Route::apiResource('experts',ExpertController::class);


//====================departments========================
Route::apiResource('departments',DepartmentController::class);


Route::get('/departments/{id}/explore', [DepartmentController::class, 'explore']);

//====================profile========================
Route::get('/user/profile', [ProfileController::class, 'user']);
Route::get('/expert/profile', [ProfileController::class, 'expert']);

//====================users========================
Route::apiResource('users', UserController::class);


Route::get('/posts/{id}/explore', [PostController::class, 'explore']);
Route::apiResource('service-ratings', ServiceRatingController::class);
