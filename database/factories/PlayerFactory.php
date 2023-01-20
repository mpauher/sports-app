<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\Position;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'level' => $this->faker->numberBetween($min = 1, $max = 5),
            'age' => $this->faker->randomNumber(2),
            'team_id' => Team::all()->random()->id,
            'position_id' => Position::all()->random()->id,
        ];
    }
}
