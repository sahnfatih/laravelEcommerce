
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;


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
     return view('welcome');
});




Route::resource('users', UserController::class);
Route::get("/users/{user}/change-password", [UserController::class, 'passwordForm'])->name('users.change-password.form');
Route::post("/users/{user}/change-password", [UserController::class, 'changePassword'])->name('users.change-password');

Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::resource('users', UserController::class);
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


