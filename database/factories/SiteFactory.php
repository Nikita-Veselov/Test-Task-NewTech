<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'site' => $this->faker->unique()->url(),
            'site_id' => $this->faker->unique()->randomNumber(3),
        ];
    }
}
