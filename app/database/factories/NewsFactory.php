<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->slug(),
            'excerpt' => fake()->text(),
            'content' => fake()->paragraphs(3, true),
            'image' => fake()->regexify('[A-Za-z0-9]{255}'),
            'category_id' => Category::factory(),
            'author_id' => User::factory(),
            'is_featured' => fake()->boolean(),
            'is_published' => fake()->boolean(),
            'published_at' => fake()->dateTime(),
            'view_count' => fake()->randomNumber(),
            'likes_count' => fake()->randomNumber(),
            'dislikes_count' => fake()->randomNumber(),
            'meta_title' => fake()->regexify('[A-Za-z0-9]{255}'),
            'meta_description' => fake()->text(),
            'reading_time' => fake()->randomNumber(),
        ];
    }
}
