<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'prefecture_id' => $this->faker->numberBetween(1, 10),
            'number' => $this->faker->numberBetween(1, 50),
            'name' => $this->faker->name,
            'thumbnail' => env('APP_URL') . '/' . '400x300.jpg',
            // 'thumbnail' => $this->faker->image(),
            'slogan' => $this->faker->realText(rand(10, 30)),
            'description' => $this->faker->realText(rand(30, 100)),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'zoom_level' => $this->faker->biasedNumberBetween(1, 15),
            'catalog_file' => Str::random(rand(50, 190)),
            'map_file' => Str::random(rand(50, 190)),
        ];
    }
}
