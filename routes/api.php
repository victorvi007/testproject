<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/unauthenticated',function(){
    return ['unauthenticated'];
})->name('unauthenticated');

Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[LoginController::class,'login']);
// Route::post('/login',[LoginController::class,'login']);

// user routes
Route::get('/all-post',[SiteController::class,'getAllPosts']);
Route::middleware('auth:api','scopes:view-post,read-post')->group(function(){

    Route::get('/post',[SiteController::class,'getUserPosts']);

    Route::get('/all-post/{id}',[SiteController::class,'getOnePost']);


});
// Admin Routes
Route::middleware('auth:api','scopes:view-post,read-post,update-post,delete-post')->group(function(){
        // Admin privilages
        Route::get('/users',[SiteController::class,'getAllUsers']);
        Route::get('/all-post/{id}',[SiteController::class,'getOnePost']);
        Route::delete('/all-post/{id}/delete',[SiteController::class,'deletePost']);
        Route::patch('/all-post/{id}/update',[SiteController::class,'updatePost']);
});
