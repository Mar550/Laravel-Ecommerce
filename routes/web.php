<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
});

Auth::routes(); //register //login (scalfoding)

Route::prefix('admin')->middleware('admin')->group(function(){
    Route::get('home',[AdminController::class,'index'])->name('admin.home');

    Route::prefix('categories')->group(function(){
        Route::get('index', [CategoryController::class,'index'])->name('admin.categories.index');
        Route::get('create', [CategoryController::class,'create'])->name('admin.categories.create');
        Route::post('store', [CategoryController::class,'store'])->name('admin.categories.store');
        Route::get('/category/{id}',[CategoryController::class,'show'])->name('admin.categories.show');
        Route::put('edit', [CategoryController::class,'edit'])->name('admin.categories.edit');
        Route::delete('delete/{id}',[CategoryController::class,'destroy'])->name('admin.categories.delete');
    });
});

Route::prefix('user')->middleware('user')->group(function(){
    Route::get('home',[UserController::class,'index'])->name('user.home');
    });















