<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AdSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'code' => fake()->regexify('[A-Za-z0-9]{50}'),
            'position' => fake()->regexify('[A-Za-z0-9]{50}'),
            'html_content' => fake()->text(),
            'image_url' => fake()->regexify('[A-Za-z0-9]{255}'),
            'link_url' => fake()->regexify('[A-Za-z0-9]{255}'),
            'width' => fake()->regexify('[A-Za-z0-9]{20}'),
            'height' => fake()->regexify('[A-Za-z0-9]{20}'),
            'is_active' => fake()->boolean(),
            'starts_at' => fake()->dateTime(),
            'ends_at' => fake()->dateTime(),
            'impressions' => fake()->randomNumber(),
            'clicks' => fake()->randomNumber(),
        ];
    }
}
