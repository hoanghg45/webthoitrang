<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Product;

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
//frontend
Route::get('/', [HomeController::class, 'index']);
Route::get('/homepage', [HomeController::class, 'index']);
//product
Route::get('/new-product', [ProductController::class, 'new_product']);
Route::get('/category-product/{category_id}', [ProductController::class, 'category_product']);
Route::get('/details-product/{product_id}', [ProductController::class, 'details_product']);
//cart
Route::get('/cart', [CartController::class, 'show_cart']);
Route::post('/add-to-cart', [CartController::class, 'add_to_cart']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::get('/delete-cart/{session_id}', [CartController::class, 'delete_cart']);
Route::get('/show-cart', [CartController::class, 'show_cart_quantity']);
//checkout
Route::get('/check-out', [CheckOutController::class, 'show_checkout']);
//user
Route::get('/sign-up', [UserController::class, 'sign_up']);


//backend
//admin
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'show_dashboard']);
Route::get('/logout', [AdminController::class, 'log_out']);
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']);
//category
Route::get('/all-category', [CategoryProduct::class, 'all_category']);

Route::get('/add-category', [CategoryProduct::class, 'add_category']);
Route::post('/save-category', [CategoryProduct::class, 'save_category']);

Route::get('/edit-category/{category_id}', [CategoryProduct::class, 'edit_category']);
Route::post('/update-category/{category_id}', [CategoryProduct::class, 'update_category']);

Route::get('/del-category/{category_id}', [CategoryProduct::class, 'del_category']);

Route::get('/unactive-category/{category_id}', [CategoryProduct::class, 'unactive_category']);
Route::get('/active-category/{category_id}', [CategoryProduct::class, 'active_category']);

//product
Route::get('/all-product', [ProductController::class, 'all_product']);

Route::get('/add-product', [ProductController::class, 'add_product']);
Route::post('/save-product', [ProductController::class, 'save_product']);

Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

Route::get('/del-product/{product_id}', [ProductController::class, 'del_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

