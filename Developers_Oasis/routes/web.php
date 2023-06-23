<?php


use App\Http\Controllers\API\UserController;
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

// Admin login route
Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm']);
Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

Auth::routes();

Route::get('/admin/dashboard',function (){
    if (Auth::user() && Auth::user()->isadmin){
        return view('homeAdmin');
    }else{
        return redirect('/home');
    }
})->name('admin.dashboard');
Route::get('/admin/dashboard/{any}', function () {
    return view('homeAdmin');
})->where('any', '.*');


Route::get('/{any}', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/{any}', function () {
        return view('home');
    })->where('any', '.*');
});

//Route::view('/admin/login','auth.loginAdmin');
//departments
//Route::get('/departments', function () {return view('departments');})->middleware('auth');
//Route::get('/adddepartments', function () {
//    return view('adddepartments');
//})->middleware('auth');
//Route::get('/departments/{id}', function ($id) {
//    return view('departmentsdetail', ['id' => $id]);
//})->middleware('auth');

// Admin login route
//Route::get('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'showAdminLoginForm'])->name('admin.login');
//Route::post('/admin/login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin']);
//
//Route::post('/users', [UserController::class, 'store'])->name('users.store');



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//expert
//Route::get('/experts', function () {return view('expert');})->middleware('auth');
//Route::get('/addexpert', function () {
//    return view('addexpert');
//})->middleware('auth');
//Route::get('/expert/{id}', function ($id) {
//    return view('expertdetail', ['id' => $id]);
//})->middleware('auth');

