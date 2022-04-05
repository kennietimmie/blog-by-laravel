<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create(),
            'title' => $this->faker->words(3,true),
            'slug' => $this->faker->unique()->slug(),
            'excerpt' => '<p>' . $this->faker->paragraph(2) . '</p>' ,
            'content' => '<p>' . $this->faker->paragraph(8) . '</p>' ,
            'published_at' => $this->faker->time(),
        ];
    }
}
