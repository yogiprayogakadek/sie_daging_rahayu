<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->namespace('Main')->group(function() {
    Route::controller(KategoriController::class)
        ->prefix('kategori')
        ->as('kategori.')
        ->group(function() {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
    });

    Route::controller(ProdukController::class)
        ->prefix('produk')
        ->as('produk.')
        ->group(function() {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
    });

    Route::controller(PemasokController::class)
        ->prefix('pemasok')
        ->as('pemasok.')
        ->group(function() {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
    });

    Route::controller(StaffController::class)
        ->prefix('staff')
        ->as('staff.')
        ->group(function() {
            Route::get('', 'index')->name('index');
            Route::get('/render', 'render')->name('render');
            Route::get('/create', 'create')->name('create');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/store', 'store')->name('store');
            Route::post('/update', 'update')->name('update');
    });

    Route::controller(PenjualanController::class)
        ->prefix('penjualan')
        ->as('penjualan.')
        ->group(function() {
            Route::get('', 'index')->name('index');
            Route::get('/cari-produk/{slug}', 'search')->name('search');
            Route::get('/print/{start_date}/{end_date}', 'print')->name('print');
            
            // detail
            Route::get('/detail', 'detail')->name('detail');
            Route::get('/detail/render', 'detailRender')->name('detail.render');
            Route::get('/detail/filter/{start_date}/{end_date}', 'detailFilter')->name('detail.filter');
    });

    Route::controller(CartController::class)
        ->prefix('cart')
        ->as('cart.')
        ->group(function() {
            Route::post('/add', 'add')->name('add');
            Route::post('/update', 'update')->name('update');
            Route::post('/checkout', 'checkout')->name('checkout');
            Route::get('/remove/{id}', 'remove')->name('remove');
            Route::get('/check-cart', 'check')->name('check');
    });

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
