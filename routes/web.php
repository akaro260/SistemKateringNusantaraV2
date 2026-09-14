<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\CourierController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MenuBrowseController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\OrderDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('menu.index');
    }

    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/orders', [OrderDashboardController::class, 'index'])->name('orders.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/menu', [MenuBrowseController::class, 'index'])->name('menu.index');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{menu}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{menu}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{menu}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    Route::get('/pesanan-saya', [MyOrderController::class, 'index'])->name('orders.mine');
});

/*
|--------------------------------------------------------------------------
| Area Admin: dashboard monitoring + CRUD master data
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::delete('/orders/{order}', [AdminOrderController::class, 'destroy'])->name('orders.destroy');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('cities', CityController::class)->except('show');
    Route::resource('payment-methods', PaymentMethodController::class)->except('show');
    Route::resource('couriers', CourierController::class)->except('show');
    Route::resource('menus', AdminMenuController::class)->except('show');
});


require __DIR__.'/auth.php';
