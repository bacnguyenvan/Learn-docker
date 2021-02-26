<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RoutePointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\RoutePoint::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'point_id' => $this->faker->biasedNumberBetween(1, 10),
            'route_id' => $this->faker->biasedNumberBetween(1, 10),
        ];
    }
}
