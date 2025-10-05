<?php

use App\Models\Order;
use App\Models\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// ----------------------------
// Public Routes
// ----------------------------
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');
// User logout route
 Route::post('/user/logout', [UserController::class, 'logout'])->name('user.logout');
// ----------------------------
// Guest Routes (Normal Users + Admin Login Form)
// ----------------------------


// Customer Login (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/customer/login', [UserController::class, 'showCustomerLoginForm'])->name('customer.login.form');
    Route::post('/customer/login', [UserController::class, 'customerLogin'])->name('customer.login.submit');
});

// Admin Login
    Route::get('/admin', [UserController::class, 'showAdminForm'])->name('admin.login');
    Route::post('/admin/login', [UserController::class, 'adminLogin'])->name('admin.login.store');
// ----------------------------
// Authenticated User Routes (Customers)
// ----------------------------

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart Routes
    Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');
    Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
    Route::post('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');

    // ----------------------------
// Authenticated User Routes (Customers)
// ----------------------------
Route::middleware(['auth'])->group(function () {
    // Checkout Routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'fetchCart'])->name('checkout.fetchCart');
    Route::post('/orders', [CheckoutController::class, 'store'])->name('orders.store');

    // Payment Route
    Route::post('/pay', [PaymentController::class, 'stkPush'])->name('pay');
});

// ----------------------------
// Admin Routes (Protected by 'auth' and 'is.admin')
// ----------------------------
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is.admin'])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/add', [UserController::class, 'create'])->name('users.add');
        Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

        // Product Management
        Route::resource('products', ProductController::class)->except(['show']);

        // Order Management
        Route::get('orders', [CheckoutController::class, 'adminOrders'])->name('orders.view');
        Route::get('/order-items', [CheckoutController::class, 'orderItems'])->name('order-items');

        // Admin Logout
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });
       
// ----------------------------
// Utility / Misc Routes
// ----------------------------
Route::get('/pay', function () {
    abort(404); // To prevent direct access
});

Route::get('/clear-cart', function () {
    session()->forget('cart');
    return 'Cart cleared!';
});

// ----------------------------
// Laravel Auth Scaffolding
// ----------------------------
require __DIR__.'/auth.php';
