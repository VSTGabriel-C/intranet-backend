<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstname(),
            'last_name' => $this->faker->lastname(),
            'enterprise_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Str::random(10),
            'token' => Str::random(43),
        ];
    }
}
