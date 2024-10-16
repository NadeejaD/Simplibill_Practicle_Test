<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('welcome');
Route::get('/post/{post}/show', [PostController::class, 'show'])->name('post.show');

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');
    Route::patch('/admin/post/approve/{post}', [PostController::class, 'approve'])->name('admin.approve');



    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');

    Route::delete('/post/{post}', [PostController::class, 'delete'])->name('post.delete');

});
