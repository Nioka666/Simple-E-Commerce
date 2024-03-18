<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\CheckoutController as UserCheckoutController;
use App\Http\Controllers\User\ProdukController as UserProdukController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UsersController;
use App\Models\KategoriProduk;
use App\Models\Produk;
use GuzzleHttp\Middleware;
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

// ================================================
// Project Laravel 8.0
// Dikerjakan oleh : Muhammad Adhim Niokagi
// Dengan menggunakan template yang disediakan
// dan mengikuti panduan dari modul yang diberikan.
// ================================================

// Client Side Routes
Route::get('/', function () {
    return redirect()->route('userDashboard');
});

Route::get('/dashboard', [UserDashboardController::class, 'main'])->name('userDashboard');
Route::post('/addToCart', [UserDashboardController::class, 'addToCart'])->name('userAddToCart');
Route::post('/removeToCart', [UserDashboardController::class, 'removeToCart'])->name('userRemoveToCart');
// checkout
Route::post('/checkout', [UserCheckoutController::class, 'main'])->name('userCheckout');
Route::post('/checkoutProses', [UserCheckoutController::class, 'proses'])->name('userCheckoutProses');
Route::get('/produk{slug}', [UserProdukController::class, 'main'])->name('userProduk');
Route::get('/checkoutHistory', [UserCheckoutController::class, 'history'])->name('userCheckoutHistory');
Route::post('/checkoutComplete', [UserCheckoutController::class, 'complete'])->name('userCheckoutComplete');


// Admin prefix (Server Side Routes)
Route::group(['prefix' => 'admin'], function () {
    // Route::get('/', function () {
    //     return redirect()->route('dashboard');
    // });
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/postLogin', [AuthController::class, 'postLogin'])->name('postLogin');
    // Middleware for login
    Route::group(['middleware' => ['checkLogin']], function () {
        Route::get('/dashboard', [DashboardController::class, 'main'])->name('dashboard');
        // Datamaster Users Routes
        Route::group(['prefix' => 'datamaster'], function () {
            Route::group(['prefix' => 'users'], function () {
                Route::get('/', [UsersController::class, 'index'])->name('users');
                Route::get('/create', [UsersController::class, 'create'])->name('usersCreate');
                Route::post('/store', [UsersController::class, 'store'])->name('usersStore');
                Route::get('/show/{id}', [UsersController::class, 'show'])->name('usersShow');
                Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('usersEdit');
                Route::post('/update/{id}', [UsersController::class, 'update'])->name('usersUpdate');
                Route::post('/post/{id}', [UsersController::class, 'update'])->name('usersPost');
                Route::get('/delete/{id}', [UsersController::class, 'destroy'])->name('usersDelete');
                Route::post('/getKabupaten', [UsersController::class, 'getKabupaten'])->name('usersGetKabupaten');
            });
            // Product Routes
            Route::group(['prefix' => 'kategori_produk'], function () {
                Route::get('/', [KategoriProdukController::class, 'index'])->name('kategoriProduk');
                Route::get('/create', [KategoriProdukController::class, 'create'])->name('kategoriProdukCreate');
                Route::post('/store', [KategoriProdukController::class, 'store'])->name('kategoriProdukStore');
                Route::get('/show/{id}', [KategoriProdukController::class, 'show'])->name('kategoriProdukShow');
                Route::get('/edit/{id}', [KategoriProdukController::class, 'edit'])->name('kategoriProdukEdit');
                Route::post('/update/{id}', [KategoriProdukController::class, 'update'])->name('kategoriProdukUpdate');
                Route::get('/delete/{id}', [KategoriProdukController::class, 'destroy'])->name('kategoriProdukDelete');
            });

            Route::group(['prefix' => 'produk'], function () {
                Route::get('/', [ProdukController::class, 'index'])->name('produk');
                Route::get('/create', [ProdukController::class, 'create'])->name('produkCreate');
                Route::post('/store', [ProdukController::class, 'store'])->name('produkStore');
                Route::get('/show/{id}', [ProdukController::class, 'show'])->name('produkShow');
                Route::get('/edit/{id}', [ProdukController::class, 'edit'])->name('produkEdit');
                Route::post('/update/{id}', [ProdukController::class, 'update'])->name('produkUpdate');
                Route::get('/delete/{id}', [ProdukController::class, 'destroy'])->name('produkDelete');
            });

            Route::group(['prefix' => 'transaksi'], function () {
                Route::get('/', [TransaksiController::class, 'index'])->name('transaksi');
                Route::get('/create', [TransaksiController::class, 'create'])->name('transaksiCreate');
                Route::post('/store', [TransaksiController::class, 'store'])->name('transaksiStore');
                Route::get('/show/{id}', [TransaksiController::class, 'show'])->name('transaksiShow');
                Route::get('/tolak/{id}', [TransaksiController::class, 'tolak'])->name('transaksiTolak');
                Route::get('/proses/{id}', [TransaksiController::class, 'proses'])->name('transaksiProses');
                Route::get('/kirim/{id}', [TransaksiController::class, 'kirim'])->name('transaksiKirim');
                Route::get('/selesai/{id}', [TransaksiController::class, 'selesai'])->name('transaksiSelesai');
            });

            // laporan
            Route::group(['prefix' => 'laporan'], function () {
                Route::group(['prefix' => 'laporan-penjualan'], function () {
                    Route::get('/', [LaporanPenjualanController::class, 'index'])->name('laporanPenjualan');
                    Route::get('/print', [LaporanPenjualanController::class, 'print'])->name('laporanPenjualanPrint');
                });
            });
        });
    });
});
