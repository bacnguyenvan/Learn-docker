<?php

namespace Database\Factories;

use App\Models\RouteActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RouteActivity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'route_id' => $this->faker->numberBetween(1, 100),
            'activity_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
