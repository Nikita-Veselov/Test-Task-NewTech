<?php

namespace Database\Factories;

use App\Models\Blacklist;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlacklistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blacklist::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'publisher_id' => $this->faker->randomNumber(1),
            'site_id' => $this->faker->unique()->randomNumber(3),
            'adv_id' => $this->faker->unique()->randomNumber(1)
        ];
    }
}
