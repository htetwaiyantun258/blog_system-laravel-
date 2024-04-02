<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

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

// Article Route start
Route::get('/articles',[ArticleController::class,'index']);
Route::get('/articles/detail/{id}',[ArticleController::class,'detail']);

Route::get('/articles/add',[ArticleController::class,'add']);
Route::post('/articles/add',[ArticleController::class,'create']);

Route::get('/articles/edit/{id}',[ArticleController::class,'edit']);
Route::post('/articles/edit/{id}',[ArticleController::class,'update']);

Route::get('/articles/delete/{id}',[ArticleController::class,'delete']);
//Article Route end

//Comment Route Start

Route::post('/comments/add',[CommentController::class,'create']);

Route::get('/comments/delete/{id}',[CommentController::class,'delete'])->middleware("auth");

//Comment Route End




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
