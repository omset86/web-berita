<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsletterSubscriberFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'email' => fake()->safeEmail(),
            'name' => fake()->name(),
            'is_active' => fake()->boolean(),
            'subscribed_at' => fake()->dateTime(),
        ];
    }
}
