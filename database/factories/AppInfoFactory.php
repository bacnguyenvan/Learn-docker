<?php

namespace Database\Factories;

use App\Models\AppInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AppInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'jet_api',
            'version' => '1.0.0',
            'term_service' => $this->faker->randomHtml()
        ];
    }
}
