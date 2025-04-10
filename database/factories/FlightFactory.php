<?php

namespace Database\Factories;
use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; # berguna untuk membuat upper/lower case

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Flight::class;
    public function definition(): array
    {
        return [
            'flight_code' => strtoupper(Str::random(2)).$this->faker->numberBetween(100,999),
            'origin' => $this->faker->randomElement(['SUB', 'CGK', 'DPS', 'BDO', 'JOG', 'SDA']),
            'destination' => $this->faker->randomElement(['CGK', 'SUB', 'UPG', 'SRG', 'PLM']),
            'departure_time' => $this->faker->dateTimeBetween('+1 days', '+2 days'),
            'arrival_time' => $this->faker->dateTimeBetween('+2 days', '+3 days'),
        ];
    }
}
