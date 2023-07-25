<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Http\Controllers\userController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\LikeController;
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
Route::get('/subir-imagen', [ImageController::class, 'create'])->name('image.create');
Route::post('/image/save',[ImageController::class, 'save'])->name('image.save');
Route::get('/image/file/{filename}', [ImageController::class, 'getImage'])->name('image.file');
Route::get('/image/{id}', [ImageController::class, 'detail'])->name('image.detail');
Route::post('/comment/save',[commentController::class, 'save'])->name('comment.save');
Route::get('/comment/delete/{id}',[commentController::class, 'delete'])->name('comment.delete');
Route::get('/like/{image_id}', [LikeController::class, 'like'])->name('like.save');
Route::get('/dislike/{image_id}', [LikeController::class, 'dislike'])->name('like.delete');