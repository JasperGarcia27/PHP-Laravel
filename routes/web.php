<?php

use Illuminate\Support\Facades\Route;

// link the PostController file
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'welcome']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route wherein a view to create a post will be returned to the user

Route::get('/posts/create', [PostController::class, 'create']);

// route wherein the form data  will be sent via POST method to the /posts endpoint
Route::post('/posts', [PostController::class, 'store']);

// route that will return a view containing all posts
Route::get('/posts', [PostController::class, 'index']);

// route that will return a view containing only the authenticated user's posts
Route::get('/myPosts', [PostController::class, 'myPosts']);

// route that will show a speacific post wtih matching URL parameter ID
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::get('/posts/{id}/edit', [PostController::class, 'editpost']);

Route::put('/updatePosts/{id}', [PostController::class, 'updatepost']);

// define a rute that willdelete a post of the matching URL parameter ID

// Route::delete('/posts/{id}', [PostController::class, 'destroy']);

Route::delete('/posts/{id}', [PostController::class, 'archive']);

// route that will call the "like" action when a PUT request is received 
Route::put('/posts/{id}/like', [PostController::class, 'like']);

Route::post('/posts/{id}/comment', [PostController::class, 'comment']);