<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get(
'/{category}',
fn (Category $category) => view('posts.index', [
'posts' => $category->posts()->latest()->paginate(12)->withQueryString(),
])
)->name('categories.single');