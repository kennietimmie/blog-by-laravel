<?php

use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('posts')->group(function () {
  Route::get('/{post:slug}', [PostController::class, 'show'])->name('posts.single');
  Route::post('/{post:slug}/comment', [CommentController::class, 'store'])->name('posts.comment.store');
});

Route::name('admin.posts.')->prefix('admin/posts')
  ->middleware(['throttle:posts', 'admin'])
  ->group(function () {

    Route::controller(AdminPostController::class)->group(function () {
      Route::get('/', 'index')->name('index');

      Route::get('/create', 'create')->name('create');
      Route::post('/', 'store')->name('store');

      Route::get('/{post}', 'edit')->name('edit');
      Route::match(['put', 'patch'], '/{post}', 'update')->name('update');
      Route::delete('/{post}', 'destroy')->name('delete');
    });

    // Route::resource('/', AdminPostController::class)->except('show')->names([
    //   'index' => 'admin.posts.index',
    //   'create' => 'admin.posts.create',
    //   'store' => 'admin.posts.store',
    //   'edit' => 'admin.posts.edit',
    //   'update' => 'admin.posts.update',
    //   'destroy' => 'admin.posts.delete',
    // ]);
  });
