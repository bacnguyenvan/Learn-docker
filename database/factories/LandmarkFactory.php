<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LandmarkFactory extends Factory
{
    use \App\Traits\GetDummyData;
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Landmark::class;

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
            'thumbnail' => env('APP_URL') . '/' . '400x300.jpg',
            'latitude' => explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0])[0],
            'longitude' => explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0])[1],
            'category' => $this->faker->word(),
            'address' => $this->faker->address,
            'tel' => $this->faker->phoneNumber,
            'icon' => env('APP_URL') . '/' . '400x300.jpg',
        ];
    }
}
