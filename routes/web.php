<?php


use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LogInController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('products');
});


Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::get('/register', 'RegistrationController@index')->middleware('guest')->name('register');
    Route::post('/register', 'RegistrationController@store');
    Route::get('/login', [LogInController::class, 'index'])->middleware('guest')->name('login.index');
    Route::post('/login', [LogInController::class, 'store'])->name('login.store');
    Route::post('/logout', [LogOutController::class, 'destroy'])->middleware('auth')->name('logout');
    Route::post('/checkPassword', [LogInController::class, 'orderPlacement'])->middleware('auth')->name('orderPlacement');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.index');
    Route::get('/admin/products', [AdminController::class, 'products'])->middleware(['auth', 'admin'])->name('admin.products');

    Route::get('/admin/products/{product}', [AdminController::class, 'productShow'])->middleware(['auth', 'admin'])->name('admin.productShow');

    Route::post('/admin/products', [AdminController::class, 'productCreate'])->middleware(['auth', 'admin'])->name('admin.productCreate');

    Route::patch('/admin/products/{product}', [AdminController::class, 'productEdit'])->middleware(['auth', 'admin'])->name('admin.productEdit');

    Route::delete('/admin/products/{product}', [AdminController::class, 'productDestroy'])->middleware(['auth', 'admin'])->name('admin.productDestroy');

    Route::get('/admin/categories', [AdminController::class, 'categories'])->middleware(['auth', 'admin'])->name('admin.categories');

    Route::post('/admin/categories', [AdminController::class, 'categoryCreate'])->middleware(['auth', 'admin'])->name('admin.categoryCreate');

    Route::patch('/admin/categories/{category}', [AdminController::class, 'categoryEdit'])->middleware(['auth', 'admin'])->name('admin.categoryEdit');

    Route::get('/admin/categories/{category}', [AdminController::class, 'categoryShow'])->middleware(['auth', 'admin'])->name('admin.categoryShow');

    Route::delete('/admin/categories/{category}', [AdminController::class, 'categoryDestroy'])->middleware(['auth', 'admin'])->name('admin.categoryDestroy');

    Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware(['auth', 'admin'])->name('admin.orders');

    Route::patch('/admin/orders/{order}', [AdminController::class, 'orderEdit'])->middleware(['auth', 'admin'])->name('admin.orderEdit');
});


Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware('auth')->name('dashboard');
Route::get('/map', function () {
    return view('map');
})->name('map');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
Route::post('/products/{product}', [ProductController::class, 'addToCart'])->name('product.addToCart');


Route::get('/about', [AboutController::class, 'index'])->name('about');


Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name('cart.index');
Route::post('/cart/{cart}', [CartController::class, 'edit'])->name('cart.edit');

Route::get('/orders', [OrderController::class, 'index'])->middleware('auth')->name('order.index');
Route::patch('/orders/{order}', [OrderController::class, 'destroy'])->middleware('auth')->name('order.delete');
