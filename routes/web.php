<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Models\CustomerLogin;
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
// fronend
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('index');
// Route::get('/', function () {
//     return view('frontend.index');
// });
//user
Auth::routes();
Route::post('/add/role', [HomeController::class, 'role']);




Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');


//Category
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'category'])->name('category');
Route::post('/category/insert', [App\Http\Controllers\CategoryController::class, 'insert'])->name('category_insert');
Route::get('/category/delete/{category_id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category_delete');
Route::get('/category/edit/{category_id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category_edit');
Route::post('/category/update', [App\Http\Controllers\CategoryController::class, 'update'])->name('category_update');
Route::get('/category/restore/{category_id}', [App\Http\Controllers\CategoryController::class, 'restore'])->name('category_restore');

//subcategory
Route::get('/subcategory', [App\Http\Controllers\SubcategoryController::class, 'subcategory'])->name('sub_category');
Route::post('/subcategory/insert', [App\Http\Controllers\SubcategoryController::class, 'insert'])->name('sub_category_insert');
Route::get('/subcategory/edit/{subcategory_id}', [App\Http\Controllers\SubcategoryController::class, 'edit'])->name('sub_category_edit');
Route::get('/subcategory/delete/{subcategory_id}', [App\Http\Controllers\SubcategoryController::class, 'delete'])->name('sub_category_delete');
Route::post('/subcategory/update', [App\Http\Controllers\SubcategoryController::class, 'update'])->name('sub_category_update');
Route::get('/subcategory/restore/{subcategory_id}', [App\Http\Controllers\SubcategoryController::class, 'restore'])->name('sub_category_restore');
Route::get('/subcategory/permanent_delete/{subcategory_id}', [App\Http\Controllers\SubcategoryController::class, 'sub_per_delete'])->name('sub_per_delete');


// Profile
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'profile_edit'])->name('profile_edit');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'profile_update'])->name('profile_update');

//product

Route::get('/add/product', [ProductController::class, 'index'])->name('add.product');
Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::post('/product/insert', [ProductController::class, 'product_insert'])->name('product.insert');
Route::get('edit/product/{product_id}', [ProductController::class, 'product_edit'])->name('product_edit');
Route::get('/product_details/{sing_product_id}', [ProductController::class, 'product_details'])->name('product_details');
Route::post('/getsize', [ProductController::class, 'getsize']);

//Inventory
Route::get('/inventory/{invenotry_id}', [ProductController::class, 'inventory'])->name('inventory');
Route::post('/inventory/insert', [ProductController::class, 'inventory_insert'])->name('inventory_insert');

//Color And Size
Route::get('/color_size', [ProductController::class, 'color_size'])->name('color_size');
Route::post('/color_size/insert', [ProductController::class, 'color_size_insert'])->name('color_size_insert');
Route::post('/size/insert', [ProductController::class, 'size_insert'])->name('size_insert');


//frontend Login & Register
Route::get('/customer_register', [CustomerRegisterController::class, 'customer_register'])->name('customer_register');
Route::post('/customer/register', [CustomerRegisterController::class, 'customerregister'])->name('customer.register');
Route::post('/customer/login', [CustomerLoginController::class, 'customerlogin'])->name('customerlogin');
//customer profile
Route::get('/customer/profile', [CustomerLoginController::class, 'customer_profile'])->name('customer_profile');
Route::post('/customer/update', [CustomerRegisterController::class, 'customer_update']);
Route::get('/customer/singout', [CustomerRegisterController::class, 'customer_singout'])->name('customer_singout');

//cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
// Route::get('/cart/{usecoupon}', [CartController::class, 'cart']);
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart_update');
Route::post('/cart/insert', [CartController::class, 'cart_insert'])->name('cart_insert');
Route::get('/cart/delete/{cart_id}', [CartController::class, 'cart_delete'])->name('cart_delete');
Route::get('/clear/cart', [CartController::class, 'clear_cart'])->name('clear_cart');
//logout



//coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/insert', [CouponController::class, 'coupon_insert'])->name('coupon_insert');
// Route::get('/logout', [LoginController::class, 'logout'])

//checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
//order
Route::post('/order/insert', [CheckoutController::class, 'order_insert']);

//getcity
Route::post('/getcity', [CheckoutController::class, 'getcity']);
//order_success
Route::get('/order/success', [CheckoutController::class, 'order_success'])->name('order_success');
//getsizeId ajax
Route::post('/getsize_id', [ProductController::class, 'getsize_id'])->name('getsizeid');
//send sizeId ajax
Route::post('/sendsize_id', [ProductController::class, 'SendsizeId'])->name('SendSizeId');