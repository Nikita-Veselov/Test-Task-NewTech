<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PublisherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'publisher' => $this->faker->unique()->name(),
            'publisher_id' => $this->faker->unique()->randomNumber(2),
        ];
    }
}
