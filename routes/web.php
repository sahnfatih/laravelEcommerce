
<?php

use App\Http\Controllers\Backend\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\CartController;


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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kategori/{category:slug}', [CategoryController::class, 'index'])->name('category.index');

// Kimlik doğrulama rotaları
Route::middleware('guest')->group(function () {
    Route::get('/giris', [AuthController::class, 'showSignInForm'])->name('signin.form');
    Route::post('/giris', [AuthController::class, 'signIn'])->name('signin');
    Route::get('/uye-ol', [AuthController::class, 'showSignUpForm'])->name('signup.form');
    Route::post('/uye-ol', [AuthController::class, 'signUp'])->name('signup');
});

// Oturum kapatma
Route::get('/cikis', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Ödeme rotaları
Route::middleware(['auth'])->group(function () {
    Route::get('/odeme', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/odeme', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});
// Sepet işlemleri
Route::middleware(['auth'])->group(function () {
    Route::get('/sepetim', [CartController::class, 'index'])->name('cart.index');
    Route::post('/sepete-ekle/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/sepetten-cikar/{cartDetails}', [CartController::class, 'remove'])->name('cart.remove');
});
Route::get('/users/{user}/change-password', [UserController::class, 'passwordForm'])->name('users.change-password.form');
Route::post('/users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');

Route::resource('users.addresses', AddressController::class);

Route::resource('users', UserController::class);


Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::resource('users', UserController::class);
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::resource('users.addresses', AddressController::class)->names('users.addresses');
Route::resource('addresses', AddressController::class);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('products.images', ProductImageController::class);
