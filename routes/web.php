<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

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

Auth::routes();

Route::get('/index', function(){
    return view('admin.dashboard');
});

Route::get('/index2', function(){
    return view('test');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/subcategories/{id}', [ProductController::class, 'loadSubCategories']);


Route::resource('category', CategoryController::class);

Route::resource('subcategory', SubCategoryController::class);

Route::resource('product', ProductController::class);
