<?php

use App\Http\Controllers\Admin\ProductCategories;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController; //phai use cai nay vo
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


////////////////////////////////////////////////
Route::get('home', function () {
    return view('client.pages.home');
});
Route::get('blog', function () {
    return view('client.pages.blog');
});
Route::get('cart', function () {
    return view('client.pages.cart');
});
////////////////////////////////////////////////
Route::get('admin', function () {
    return view('admin.layout.master');
});
// Route::get('admin/product', function () {
//     return view('admin.pages.product.list');
// });
// Route::get('admin/user', function () {
//     return view('admin.pages.user.list');
// });
///////////////////////////////////////////////////////
//Route::get('admin/product', [ProductController::class,'index'])->name('admin.product.list');
//Route::get('admin/user', [UserController::class,'index'])->name('admin.user.list'); // chi dinh controller de show page ra
//Route::get('admin/product_categories',[ProductCategories::class,'index'])->name('admin.product_categories.list');
//Route::get('admin/product_categories/add',[ProductCategories::class,'add'])->name('admin.product_categories.add');//dat ten cho Route thi sau nay ben ::get('admin') doi duong link thi van xai dc

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('product', [ProductController::class, 'index'])->name('product.list');
    Route::get('user', [UserController::class, 'index'])->name('user.list');
    Route::get('product_categories', [ProductCategories::class, 'index'])->name('product_categories.list');
    Route::get('product_categories/add', [ProductCategories::class, 'add'])->name('product_categories.add');
    Route::post('product_categories/store', [ProductCategories::class, 'store'])->name('product_categories.store');
});

require __DIR__ . '/auth.php';
