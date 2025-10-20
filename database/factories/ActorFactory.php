<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'email' => fake()->unique()->safeEmail(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'address' => fake()->address(),
            'height' => fake()->numberBetween(150, 200) . 'cm',
            'weight' => fake()->numberBetween(50, 100) . 'kg',
            'gender' => fake()->randomElement(GenderEnum::cases()),
            'age' => fake()->numberBetween(18, 80),
            'description' => fake()->sentence(12),
        ];
    }
}
