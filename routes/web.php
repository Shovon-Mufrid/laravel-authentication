<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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

Route::get('about',function(){
    $headline = "This is headline";
    $para = "This is a paragraph for laravel";
    return view('about',compact('headline','para'));
});

Route::get('media-center', function () {
    $cars = ['porche', 'BMW', 'Lamborgini'];
    return view('media',compact('cars'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//users
Route::get('/users', [HomeController::class, 'users'])->name('users');
Route::get('/user/delete/{user_id}',[HomeController::class, 'user_delete'])->name('user.delete'); //delete
//users-profile
Route::get('/profile',[HomeController::class, 'profile'])->name('profile');
Route::post('/name/update',[HomeController::class, 'name_update']);
Route::post('/pass/update',[HomeController::class, 'pass_update']);
Route::post('/photo/update',[HomeController::class, 'photo_update']);

//category
Route::get('/category', [CategoryController::class, 'index'])->name('add_category');
Route::post('/category/insert', [CategoryController::class, 'insert']);
Route::get('/category/delete/{category_id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update', [CategoryController::class, 'update']);
Route::get('/category/restore/{category_id}', [CategoryController::class, 'restore'])->name('category.restore');
Route::get('/category/hard_delete/{category_id}', [CategoryController::class, 'hard_delete'])->name('category.hard_delete');
Route::post('/mark/delete', [CategoryController::class, 'mark_delete']);


//dashboard
// Route::get('/dash', [HomeController::class, 'dash']);
