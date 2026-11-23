<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\Parent;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'news_id' => News::factory(),
            'user_id' => User::factory(),
            'author_name' => fake()->regexify('[A-Za-z0-9]{100}'),
            'author_email' => fake()->regexify('[A-Za-z0-9]{100}'),
            'content' => fake()->paragraphs(3, true),
            'status' => fake()->regexify('[A-Za-z0-9]{20}'),
            'likes_count' => fake()->randomNumber(),
            'dislikes_count' => fake()->randomNumber(),
            'parent_id' => Parent::factory(),
        ];
    }
}
