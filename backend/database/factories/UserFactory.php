<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $created_at = $this->faker->dateTimeThisYear();
        $updated_at = $this->faker->dateTimeThisYear($created_at);

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
            'phone' => $this->faker->phoneNumber,
            'email_verified_at' => $this->faker->optional()->dateTimeBetween($created_at, 'now'),
            'password' => Hash::make('12345678'),
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
