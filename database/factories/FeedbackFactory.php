<?php

namespace Database\Factories;

use App\Models\Resort;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'feedback' => fake()->words(10, true),
            'user_id' => User::inRandomOrder()->value('id'),
            'resort_id' => Resort::inRandomOrder()->value('id'),
            'trip_id' => Trip::inRandomOrder()->value('id'),
        ];
    }
}
