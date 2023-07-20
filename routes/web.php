<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Http\Controllers\userController;
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
    /*$images = Image::all();
    foreach ($images as $image){
        var_dump($image);
    }*/

    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/configuracion',[userController::class, 'config'])->name('config');
Route::post('/user/update', [userController::class, 'update'])->name('user.update');
Route::get('/user/avatar/{filename}', [userController::class, 'getImage'])->name('user.avatar');