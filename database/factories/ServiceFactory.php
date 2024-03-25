<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->sentence(),
            'type' => $this->faker->unique()->sentence(),
            'image' => Str::random(30),
            'username' => Str::random(10),
            'password' => Str::random(10),
            'base_url' => Str::random(43),
        ];
    }
}
