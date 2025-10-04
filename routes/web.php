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

Route::get('/', [HomeController::class, 'home'])->name('home');
//Route::get('/', function () {
  //  return view('welcome');
//});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/admin', function () {
    if (auth()->check() && auth()->user()->role !== 'admin') {
        return redirect('/'); // redirect non-admin users
    }
    return view('admin.login');
})->name('admin.login')->middleware('guest');


// Admin Authentication
Route::post('/admin/login', function () {
    $credentials = request()->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role !== 'admin') {
            Auth::logout(); // prevent non-admin from logging in
            return back()->withErrors([
                'email' => 'You are not authorized as admin.',
            ]);
        }

        request()->session()->regenerate();
        return redirect('/admin/dashboard');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->name('admin.login.store');

// Admin Logout
Route::post('/admin/logout', function () {
    $user = Auth::user();
    if (!$user || $user->role !== 'admin') {
        abort(403); // forbidden
    }
    
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin');
})->name('admin.logout');

// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/add', [UserController::class, 'create'])->name('users.add');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('orders', [CheckoutController::class, 'adminOrders'])->name('orders.view');
});

// Cart routes
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('update.cart');
Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('clear.cart');
Route::post('/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('remove.from.cart');
Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');

Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'fetchCart'])->name('checkout.fetchCart');
    Route::post('/orders', [CheckoutController::class, 'store'])->name('orders.store');
});

Route::post('/pay', [PaymentController::class, 'stkPush'])->name('pay');
Route::get('/pay', function () {
    abort(404); // show Laravel's 404 page
});


Route::get('/clear-cart', function () {
    Session::forget('cart');
    return 'Cart cleared!';
});




Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.details');


require __DIR__.'/auth.php';
