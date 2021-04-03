<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->text(100),
            'delivery_time' => $this->faker->dateTimeBetween('now', '+5 days'),
        ];
    }
}
