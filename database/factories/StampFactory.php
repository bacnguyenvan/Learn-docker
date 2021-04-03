<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StampFactory extends Factory
{
    use \App\Traits\GetDummyData;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Stamp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' =>  $this->faker->word,
            'thumbnail' => env('APP_URL') . '/'  . '400x300.jpg',
            'latitude' => explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0])[0],
            'longitude' => explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0])[1],
            'type' => $this->faker->word(),
        ];
    }
}
