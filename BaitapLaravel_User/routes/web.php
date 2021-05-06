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

/*Route::get('/', function () {
    return view('user-list-view');
Route::resource('/','HomeController');
});

//Route::get('/user-list-view', [UserinsertController::class, 'index'])->name('showlist');
=======
*/

Route::get('home', [\App\Http\Controllers\HomeController::class, 'index'])->name('show_list');
Route::get('/create_user', [\App\Http\Controllers\HomeController::class, 'create'])->name('create_user');
Route::get('/store', [\App\Http\Controllers\HomeController::class, 'store'])->name('store_user');
Route::get('/edit/{id}', [\App\Http\Controllers\HomeController::class, 'edit'])->name('edit_user');
Route::post('/edit/{id}', [\App\Http\Controllers\HomeController::class, 'update'])->name('update_user');
Route::post('/delete/{id}', [\App\Http\Controllers\HomeController::class, 'destroy'])->name('delete_user');
