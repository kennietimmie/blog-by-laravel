<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
  Route::get('/{post:slug}', [PostController::class, 'show'])->name('posts.single');
  Route::post('/{post:slug}/comment', [CommentController::class, 'store'])->name('posts.comment.store');
});

Route::prefix('admin/posts')->middleware('admin')->group(function () {
  Route::get('/', [AdminPostController::class, 'index'])->name('admin.posts.index');

  Route::get('/create', [AdminPostController::class, 'create'])->name('admin.posts.create');
  Route::post('/', [AdminPostController::class, 'store'])->name('admin.posts.store');

  Route::get('/{post}', [AdminPostController::class, 'edit'])->name('admin.posts.edit');
  Route::patch('/{post}', [AdminPostController::class, 'update'])->name('admin.posts.update');
  Route::delete('/{post}', [AdminPostController::class, 'destroy'])->name('admin.posts.delete');

  // Route::resource('/', AdminPostController::class)->except('show')->names([
  //   'index' => 'admin.posts.index',
  //   'create' => 'admin.posts.create',
  //   'store' => 'admin.posts.store',
  //   'edit' => 'admin.posts.edit',
  //   'update' => 'admin.posts.update',
  //   'destroy' => 'admin.posts.delete',
  // ]);
});
