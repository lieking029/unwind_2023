<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use App\Models\Resort;
use Illuminate\Support\Str;
use App\Enums\TripStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => Property::inRandomOrder()->value('id'),
            'user_id' => User::inRandomOrder()->value('id'),
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(2),
            'status' => TripStatusEnum::getRandomInstance(),
            'price' => random_int(100, 999),
            'reference_number' => Str::random(),
            'participants_count' => random_int(1, 10),
            'is_rated' => fake()->boolean(),
        ];
    }
}
