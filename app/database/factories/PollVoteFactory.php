<?php

namespace Database\Factories;

use App\Models\Poll;
use App\Models\PollOption;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PollVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'poll_id' => Poll::factory(),
            'poll_option_id' => PollOption::factory(),
            'user_id' => User::factory(),
            'ip_address' => fake()->regexify('[A-Za-z0-9]{45}'),
            'user_agent' => fake()->text(),
        ];
    }
}
