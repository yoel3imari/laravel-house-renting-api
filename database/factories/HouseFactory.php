<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\House>
 */
class HouseFactory extends Factory
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
            'location_latitude' => $this->faker->latitude, 
            'location_longitude' => $this->faker->longitude,
            'nbr_bedroom' => $this->faker->randomNumber(1, true),
            'nbr_bath' => $this->faker->randomNumber(1, true),
            'wifi' => $this->faker->boolean(50),
            'is_equipped' => $this->faker->boolean(50),
            'is_furnished' => $this->faker->boolean(50),
            'surface' => $this->faker->randomNumber(3),
            'type' => $this->faker->randomElement(['apartment', 'duplex', 'reyad', 'villa', 'penthouse']),
            'title' => $this->faker->title(),
            'desc' => $this->faker->realText(),
            'rent_price' => $this->faker->numberBetween(20, 50000),
            'rent_by' => $this->faker->randomElement(['year', 'semester', 'trimester', 'month', 'week', 'day']),
            'user_id' => User::inRandomOrder()->first()->id,
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
    }
}
