<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SceneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Scene::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'thumbnail' => env('APP_URL') . '/' . '400x300.jpg',
        ];
    }
}
