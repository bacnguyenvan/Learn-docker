<?php

namespace Database\Factories;

use App\Models\Track;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Track::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'route_id' => $this->faker->numberBetween($min = 1, $max = 100),
            'member_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'name' => $this->faker->name,
            'description' => $this->faker->text($maxNbChars = 190),
            'type' => $this->faker->name,
        ];
    }
}
