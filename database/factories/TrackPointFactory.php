<?php

namespace Database\Factories;

use App\Models\TrackPoint;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackPointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrackPoint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'track_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'elevation' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 9999),
            'data' => $this->faker->word(),
            'timestamp' => now(),
        ];
    }
}
