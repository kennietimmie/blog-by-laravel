<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory([
            'email' => 'admin@localhost.dev',
            'role' => 'administrator',
        ])->create();
        Post::factory([
            'user_id' => $user->id,
        ])->create();
        Category::create([
            'name' => 'Uncategorized',
            'slug' => 'uncategorized'
        ]);
       Category::factory(3)->create();

        $users = User::factory(5)->create();
        $users->map(
            fn ($user) =>
            Post::factory(3, [
                'user_id' => $user->id
            ])->create()->map(fn ($post) =>
            PostCategory::factory(2,
                [
                    'post_id' => $post->id,
                ]
            )->create())
        );

        Comment::factory(4)->create();
    }
}
