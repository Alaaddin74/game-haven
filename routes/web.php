<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Redirect dashboard berdasarkan role
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role === 'customer') {
        return redirect()->route('customer.dashboard');
    }

    abort(403);
})->middleware(['auth', 'verified'])->name('dashboard');

// Profil user (bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------- ADMIN ----------------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::resource('/users', UserController::class)->names('admin.users');
    Route::resource('/products', ProductController::class)->names('admin.products');
});

// ---------------- CUSTOMER ----------------
Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    // Dashboard Produk + Pencarian & Filter
    Route::get('/dashboard', function (Request $request) {
        $query = $request->input('q');
        $categoryId = $request->input('category');

        $products = Product::query();

        if ($query) {
            $products->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            });
        }

        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        $products = $products->get();
        $categories = Category::all();

        return view('customer.dashboard', compact('products', 'categories', 'query', 'categoryId'));
    })->name('customer.dashboard');

    // Cart Routes via OrderController
    Route::get('order/success/{order}', [OrderController::class, 'success'])->name('customer.success');
    Route::get('/cart', [OrderController::class, 'cart'])->name('customer.cart');
    Route::post('/order/add/{id}', [OrderController::class, 'addToCart'])->name('order.add');
    Route::delete('/order/remove/{item}', [OrderController::class, 'removeItem'])->name('order.remove');
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

});

// Otentikasi (Breeze default)
require __DIR__.'/auth.php';
