
<?php

use App\Http\Controllers\Backend\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageController;

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
     return ('ANASAYFA');
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
