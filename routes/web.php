<?php

use App\Models\Catalog;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatalogController;
use Illuminate\Routing\Route as RoutingRoute;

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

Route::get('/', function () {
    return view('home', [
        'title' => 'SneakersID',
        'catalogs' => Catalog::get()
    ]);
})->name('home');

Route::fallback(function () {
    return view('404', [
        'title' => '404'
    ]);
});



//UserController
Route::get('/login', [UserController::class, 'indexLogin'])
    ->middleware('guest')
    ->name('login');

Route::get('/register', [UserController::class, 'indexRegister'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [UserController::class, 'login'])
    ->middleware('guest');

Route::post('/register', [UserController::class, 'register'])
    ->middleware('guest');

Route::get('/profile', [UserController::class, 'profile'])
    ->middleware('auth')
    ->name('profile');

Route::get('/profile/logout', [UserController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::post('/profile/update/{name}', [UserController::class, 'update'])
    ->middleware('auth')
    ->name('update_profile');

Route::get('/profile/remove/avatar', [UserController::class, 'removeAvatar'])
    ->middleware('auth')
    ->name('remove_avatar');

Route::delete('/profile/account', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('remove_account');

Route::post('/cart/checkout/verify', [UserController::class, 'checkoutVerify'])
    ->middleware('auth')
    ->name('checkout_verify');




//CatalogController
Route::get('/cart', [CatalogController::class, 'cart'])
    ->middleware('auth')
    ->name('cart');

Route::post('/cart', [CatalogController::class, 'addCart'])
    ->middleware('auth')
    ->name('add_cart');

Route::delete('/cart/{id}', [CatalogController::class, 'removeCart'])
    ->middleware('auth')
    ->name('remove_cart');

Route::get('/cart/total', [CatalogController::class, 'totalCart'])
    ->middleware('auth')
    ->name('total_cart');

Route::get('/wishlist', [CatalogController::class, 'wishlist'])
    ->middleware('auth')
    ->name('wishlist');

Route::post('/wishlist', [CatalogController::class, 'addWishlist'])
    ->middleware('auth')
    ->name('add_wishlist');

Route::delete('/wishlist/{id}', [CatalogController::class, 'removeWishlist'])
    ->middleware('auth')
    ->name('remove_wishlist');

Route::get('/wishlist/total', [CatalogController::class, 'totalWishlist'])
    ->middleware('auth')
    ->name('total_wishlist');

Route::get('/detail/{id}', [CatalogController::class, 'detail'])
    ->middleware('auth')
    ->name('detail');

Route::post('/admin/dashboard/catalog/add', [CatalogController::class, 'store'])
    ->middleware('admin')
    ->name('add_item');

Route::delete('/admin/dashboard/catalog/{id}', [CatalogController::class, 'destroy'])
    ->middleware('admin')
    ->name('remove_item');

Route::put('/admin/dashboard/catalog/{id}', [CatalogController::class, 'update'])
    ->middleware('admin')
    ->name('update_item');

Route::post('/', [CatalogController::class, 'search'])
    ->middleware('auth')
    ->name('search');




//AdminController
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware('admin')
    ->name('dashboard');

Route::get('/admin/dashboard/catalog', [AdminController::class, 'indexCatalog'])
    ->middleware('admin')
    ->name('catalog');

Route::get('/admin/dashboard/catalog/add', [AdminController::class, 'indexAddItem'])
    ->middleware('admin')
    ->name('index_add_item');

Route::get('/admin/dashboard/catalog/edit/{id}', [AdminController::class, 'indexUpdateItem'])
    ->middleware('admin')
    ->name('index_update_item');

Route::get('/admin/dashboard/users', [AdminController::class, 'indexUsers'])
    ->middleware('admin')
    ->name('users');

Route::delete('/admin/dashboard/users/{id}', [AdminController::class, 'destroy'])
    ->middleware('admin')
    ->name('remove_user');

Route::post('/admin/dashboard/users/update/role/{id}', [AdminController::class, 'updateRole'])
    ->middleware('admin')
    ->name('update_role');
