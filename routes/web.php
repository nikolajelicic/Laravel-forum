<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
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

Route::get('/', [PagesController::class, 'showHomePage']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/view-post/{slug}', [PostsController::class, 'getPostBySlug']);
Route::get('/category/{id}', [PostsController::class, 'getPostsByCategory']);
Route::post('/searchBy', [PostsController::class, 'getPostsByText']);

Route::middleware('auth')->group(function () {
    Route::get('/user/new-post', [PagesController::class, 'showNewPostPage']);
    Route::get('/user/edit/{id}', [PagesController::class, 'showEditPostPage']);

    Route::post('/user/commentReplay', [CommentsController::class, 'replyToComment']);
    Route::get('/user/delete-comment/{id}', [CommentsController::class, 'deleteComment']);

    Route::put('/user/edit/editingPost/{id}', [PostsController::class, 'editPost']);
    Route::get('/user/view-post/{slug}', [PostsController::class, 'getPostBySlug']);
    Route::get('/user/all-my-post', [PostsController::class, 'allMyPost']);
    Route::get('/user/delete/{id}', [PostsController::class, 'deletePost']);
    Route::post('/user/save-post', [PostsController::class, 'createNewPost']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
