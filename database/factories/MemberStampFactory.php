<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MemberStampFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\MemberStamp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => $this->faker->numberBetween(1, 10),
            'stamp_id' => $this->faker->numberBetween(1, 100),
            'route_id' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTime()
        ];
    }
}
