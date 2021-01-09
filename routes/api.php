<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\blogController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\comentaryController;
use App\Http\Controllers\usersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/createBlog', [blogController::class, 'create']);
Route::get('/readBlog', [blogController::class, 'read']);
Route::get('/readBlogOne', [blogController::class, 'readOne']);
Route::post('/updateBlog', [blogController::class, 'update']);
Route::post('/deleteBlog', [blogController::class, 'delete']);

Route::get('/readUsers', [usersController::class, 'read']);
Route::get('/readUser', [usersController::class, 'readOne']);
Route::post('/updateUser', [usersController::class, 'update']);
Route::post('/deleteUser', [usersController::class, 'delete']);

Route::get('/readCategories', [categoriesController::class, 'readCategories']);
Route::post('/createCategory', [categoriesController::class, 'create']);
Route::post('/deletCategory', [categoriesController::class, 'delete']);

Route::post('/createCommentary', [comentaryController::class, 'create']);
Route::post('/deletCommentary', [comentaryController::class, 'delete']);
Route::get('/readCommentaries', [comentaryController::class, 'readCommentaries']);



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

