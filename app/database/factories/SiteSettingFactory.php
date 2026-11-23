<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiteSettingFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'site_name' => fake()->regexify('[A-Za-z0-9]{100}'),
            'site_tagline' => fake()->regexify('[A-Za-z0-9]{255}'),
            'ticker_text' => fake()->text(),
            'ticker_enabled' => fake()->boolean(),
            'location_text' => fake()->regexify('[A-Za-z0-9]{100}'),
            'footer_about' => fake()->text(),
            'footer_address' => fake()->regexify('[A-Za-z0-9]{255}'),
            'footer_phone' => fake()->regexify('[A-Za-z0-9]{50}'),
            'footer_email' => fake()->regexify('[A-Za-z0-9]{100}'),
            'social_facebook' => fake()->regexify('[A-Za-z0-9]{255}'),
            'social_twitter' => fake()->regexify('[A-Za-z0-9]{255}'),
            'social_instagram' => fake()->regexify('[A-Za-z0-9]{255}'),
            'social_youtube' => fake()->regexify('[A-Za-z0-9]{255}'),
            'meta_title' => fake()->regexify('[A-Za-z0-9]{255}'),
            'meta_description' => fake()->text(),
            'google_analytics' => fake()->regexify('[A-Za-z0-9]{50}'),
        ];
    }
}
