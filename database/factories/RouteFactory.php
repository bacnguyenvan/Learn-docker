<?php

namespace Database\Factories;

use App\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    use \App\Traits\GetDummyData;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Route::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area_id' => $this->faker->numberBetween($min = 1, $max = 10),
            'number' => $this->faker->numberBetween($min = 1, $max = 50),
            'name' => $this->faker->name,
            'description' => $this->faker->text($maxNbChars = 190),
            'movement' => $this->faker->name,
            'stamina_level' => $this->faker->numberBetween($min = 1, $max = 5),
            'range' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 9999),
            'max_elevation' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 9999),
            'journey_time' => $this->faker->randomNumber(),
            'zoom_level' => 15,
            'geometry' => $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 5),
            'point_center' => '31.420902 130.112913',
            'line_color' => $this->faker->name,
        ];
    }
}
