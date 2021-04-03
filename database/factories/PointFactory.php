<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PointFactory extends Factory
{
    use \App\Traits\GetDummyData;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Point::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'area_id' => $this->faker->numberBetween(1, 10),
            'support_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word(),
            'number' => $this->faker->numberBetween(1, 50),
            'title' =>  $this->faker->word,
            'description' =>  $this->faker->word,
            'address' => $this->faker->address,
            'category' => $this->faker->word(),
            'tel' => $this->faker->phoneNumber,
            'latitude' => explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0])[0],
            'longitude' => explode(" ", $this->faker->randomElements($this->dummyData("database/data/coordinates.json"), 1)[0])[1],
            'elevation' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 9999),
            'thumbnail' => env('APP_URL') . '/'  . '400x300.jpg',
            'distance_to_next' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 9999),
            'time_to_next' => $this->faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 9999),
            'site_url' => $this->faker->url,
            'montbell_friend_shop' => $this->faker->url,
            'other' => $this->faker->word,
        ];
    }
}
