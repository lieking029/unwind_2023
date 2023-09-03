<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\Resort;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::inRandomOrder()->value('id');
        return [
            'user_id' => $userId,
            'merchant_id' => User::whereKeyNot($userId)->value('id'),
            'amount_due' => random_int(100, 999),
            'paymnet_method' => 'Bank',
            'reference_number' => Str::random(16),
            'property_id' => Property::inRandomOrdeR()->value('id'),
        ];
    }
}
