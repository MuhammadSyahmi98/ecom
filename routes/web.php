<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\FrontProductListController;

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

// Route::get('/', function () {
//     return view('product');
// });

Route::get('/', [FrontProductListController::class, 'index'])->name('products');


Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [FrontProductListController::class, 'show'])->name('product.view');
Route::get('/{name}', [FrontProductListController::class, 'showCategory'])->name('product-list');

RouteL::get('/adToCart/{product}', [CartController::class,'addToCart'])->name('add.cart');

ROute::group([ 'middleware'=>['auth','isAdmin']], function() {



Route::get('/dasboard', function(){
    return view('admin.dashboard');
});



Route::get('/subcategories/{id}', [ProductController::class, 'loadSubCategories']);




Route::resource('category', CategoryController::class);

Route::resource('subcategory', SubCategoryController::class);

Route::resource('product', ProductController::class);

});


