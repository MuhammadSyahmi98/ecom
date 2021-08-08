<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ToyyibpayController;
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

Route::get('/orders', [CartController::class, 'showOrders'])->name('showOrders')->middleware('auth');

Route::get('/payment', [ToyyibpayController::class, 'paymentStatus'])->name('paymentStatus');
Route::get('/carts', [CartController::class, 'showCart'])->name('view.carts');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [FrontProductListController::class, 'show'])->name('product.view');
Route::get('/category/{name}', [FrontProductListController::class, 'showCategory'])->name('product-list');

Route::get('/adToCart/{product}', [CartController::class,'addToCart'])->name('add.cart');

Route::post('/products/{product}', [CartController::class, 'updateCart'])->name('update.cart');
Route::post('/product/{product}', [CartController::class, 'removeCart'])->name('remove.cart');



Route::post('/payment', [ToyyibpayController::class, 'createBill'])->name('createBill')->middleware('auth');



Route::get('/payments', [ToyyibpayController::class, 'callBack'])->name('callBack');

Route::get('/checkout/{amount}', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');


ROute::group([ 'middleware'=>['auth','isAdmin']], function() {



Route::get('/dasboard', function(){
    return view('admin.dashboard');
});



Route::get('/subcategories/{id}', [ProductController::class, 'loadSubCategories']);




Route::resource('category', CategoryController::class);

Route::resource('subcategory', SubCategoryController::class);

Route::resource('product', ProductController::class);

});


