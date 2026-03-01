<?php

use Illuminate\Support\Facades\Route;

// Store
use App\Livewire\Store\HomePage;
use App\Livewire\Store\Catalog;
use App\Livewire\Store\ProductShow;
use App\Livewire\Store\Cart;
use App\Livewire\Store\Checkout;

// Admin
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Category\Index as CategoryIndex;
use App\Livewire\Admin\Category\Form as CategoryForm;
use App\Livewire\Admin\Product\Index as ProductIndex;
use App\Livewire\Admin\Product\Form as ProductForm;
use App\Livewire\Admin\Order\Index as OrderIndex;
use App\Livewire\Admin\Order\Show as OrderShow;

Route::get('/', HomePage::class)->name('home');
Route::get('/products', Catalog::class)->name('catalog');
Route::get('/products/{slug}', ProductShow::class)->name('products.show');
Route::get('/cart', Cart::class)->name('cart');
Route::get('/checkout', Checkout::class)
    ->middleware('auth')
    ->name('checkout');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('can:admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/', AdminDashboard::class)->name('dashboard');

            Route::get('/categories', CategoryIndex::class)->name('categories.index');
            Route::get('/categories/create', CategoryForm::class)->name('categories.create');
            Route::get('/categories/{category}/edit', CategoryForm::class)->name('categories.edit');

            Route::get('/products', ProductIndex::class)->name('products.index');
            Route::get('/products/create', ProductForm::class)->name('products.create');
            Route::get('/products/{product}/edit', ProductForm::class)->name('products.edit');

            Route::get('/orders', OrderIndex::class)->name('orders.index');
            Route::get('/orders/{order}', OrderShow::class)->name('orders.show');
        });
});

require __DIR__ . '/settings.php';
