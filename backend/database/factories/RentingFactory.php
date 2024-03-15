<?php

namespace Database\Factories;

use App\Models\House;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RentingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $house = House::inRandomOrder()->first();
        $created_at = $this->faker->dateTimeBetween($house->created_at, 'now');
        $updated_at = $this->faker->dateTimeBetween($created_at, 'now');
        return [
            "house_id" => $house->id,
            "user_id" => User::inRandomOrder()->first()->id,
            "started_at" => $this->faker->dateTimeBetween($created_at, 'now'),
            "ended_at" => $this->faker->optional()->dateTimeBetween("started_at", "now"),
            "rent_price" => $this->faker->numberBetween(20, $house->rent_price),
            "rent_by" => $this->faker->randomElement(['year', 'semester', 'trimester', 'month', 'week', 'day']),

            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];

        
    }
}
