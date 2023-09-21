<?php

use App\Http\Controllers\Admin\ProductCategoriesController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController; //phai use cai nay vo
use App\Http\Controllers\Client\HomeController;
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

Route::prefix('admin')->middleware('auth.admin')->name('admin.')->group(function () {

    //Product
    // Route::get('product', [ProductController::class, 'index'])->name('product.list');
    Route::resource('product', ProductController::class); // no tu qui dinh URL vs function thuc hien, dung php artisan route:list de xem
    Route::get('product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::post('product/create/slug', [ProductController::class, 'createSlug'])->name('product.create.slug');
    Route::post('product/ckfinder_upload_image', [ProductController::class, 'uploadImage'])->name('product.ckfinder.uploade.image');
    //User
    Route::get('user', [UserController::class, 'index'])->name('user.list');

    //product categories
    Route::get('product_categories', [ProductCategoriesController::class, 'index'])->name('product_categories.list');
    Route::get('product_categories/add', [ProductCategoriesController::class, 'add'])->name('product_categories.add');
    Route::post('product_categories/store', [ProductCategoriesController::class, 'store'])->name('product_categories.store');
    Route::get('product_categories/{id}', [ProductCategoriesController::class, 'detail'])->name('product_categories.detail');
    Route::post('product_categories/update/{id}', [ProductCategoriesController::class, 'update'])->name('product_categories.update');
    Route::get('product_categories/destroy/{id}', [ProductCategoriesController::class, 'destroy'])->name('product_categories.destroy');
});

require __DIR__ . '/auth.php';

Route::get('7up', function () {
    return '7up';
});
Route::get('chivas', function () {
    return 'chivas';
})->middleware('age.18');

// 1 product category has manu N product

// 1 product belong to 1 product category

Route::get('product_list', [HomeController::class, 'index'])->name('product_list.index');
