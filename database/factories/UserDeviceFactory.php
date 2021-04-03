<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\UserDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDevice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'device_token' => Str::random(20),
            'device_agent' => $this->faker->userAgent(),
        ];
    }
}
