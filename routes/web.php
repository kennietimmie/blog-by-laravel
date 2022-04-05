<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Dashboard

Route::get('/', [PostController::class, 'index'])->name('welcome');

Route::get('/author/{author:username}', fn (User $author) =>  view('posts.index', [
    'posts' => $author->posts()->latest()->paginate(12)->withQueryString(),
]))->name('posts.author');

Route::get('/dashboard', fn () => view('dashboard'))->middleware(['auth'])->name('dashboard');

/**
 * Admin post routes are in the post.php
 */

Route::prefix('categories')->group(__DIR__ . '\category.php');
Route::prefix('')->group(__DIR__ . '\mailchimp.php');

require __DIR__ . '/auth.php';