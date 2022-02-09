<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SinglePageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\UserDataController;
use App\Http\Middleware\AdminAuthorize;
use App\Models\UserData;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard'); #->middleware(['auth', 'verified']) 

require __DIR__ . '/auth.php';

Route::get('/', [HomeController::class, 'index'])->name('home');  #->middleware('password.confirm');

// *** this route for testing eorm relaionship model ****
Route::get('test', [UserDataController::class, 'index'])->middleware(['auth', 'verified']);


Route::get('/single/{id}', [SinglePageController::class, 'index'])->name('single');
Route::post('/single/{id} ', [SinglePageController::class, 'review_save']);
Route::get('/addToCart/{id}', [CartController::class, 'addToCart']);
Route::get('cart', [CartController::class, 'index']);   #->middleware('can:isAdmin')
Route::get('removeCart/{id?}', [CartController::class, 'deleteCart']);

Route::get('checkout', [CheckoutController::class, 'index'])->middleware('auth');
Route::post('checkout', [CheckoutController::class, 'store']);

Route::middleware(['auth', 'verified' ])->group(function () {
    Route::get('myprofile', [MyProfileController::class, 'index'])->name('my-profile');
    Route::get('updateAddress', [CheckoutController::class, 'showUpdateForm']);
    Route::post('updateAddress', [CheckoutController::class, 'updateAddress']);

    Route::get('viewOrder/{id}', [OrdersController::class, 'index'])->name('vieworder');
    Route::get('cancelOrder/{id}', [OrdersController::class, 'cancelOrder'])->name('cancelorder');
    Route::post('cancelOrder/{id}', [OrdersController::class, 'destroy']);
});



Route::middleware([AdminAuthorize::class])->group(function () {
    Route::get('/admin/index', [AdminController::class, 'show'])->middleware('auth');
    Route::get('/admin/add-product', [ProductController::class, 'addproduct'])->name('addproduct');
    Route::post('/admin/add-product', [ProductController::class, 'store']);
});
