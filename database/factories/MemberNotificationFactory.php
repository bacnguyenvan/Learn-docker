<?php

namespace Database\Factories;

use App\Models\MemberNotification;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberNotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => $this->faker->numberBetween(1, 8),
        ];
    }
}
