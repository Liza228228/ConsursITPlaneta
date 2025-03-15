<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\AdminController;



Route::prefix('lk')->group(function () {
    // Регистрация и авторизация для гостей
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

    // Выход только для авторизованных пользователей

    // Доступ к профилю только для авторизованных пользователей
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile/profile.show')->middleware('auth');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update')->middleware('auth');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

//каталог продукции
Route::get('/catalog', [CatalogController::class, 'index'])->name('shop.catalog');
Route::get('/product/{id}', [CatalogController::class, 'show'])->name('shop.product.show');
Route::get('/search', [CatalogController::class, 'search'])->name('shop.search');


//маршруты для админа
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::put('/orders/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update');

    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
});


// Публичные маршруты
Route::get('/', function () {
    return view('index');
});

//оформление заказа
Route::post('/shop/checkout', [OrderController::class, 'checkout'])->name('shop.checkout')->middleware('auth');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');


//корзина
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('shop.cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('shop.cart.show');
Route::put('/cart/update/{id}', [CartController::class, 'updateCart'])->name('shop.cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('shop.cart.remove');


Route::get('/help', function () {
    return view('help');
});
