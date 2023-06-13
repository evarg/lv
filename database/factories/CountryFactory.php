<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->country(),
            'code_alpha_2' => substr(fake()->countryISOAlpha3(), 0,2),
            'code_alpha_3' => fake()->countryISOAlpha3(),
            'code_numeric' => fake()->randomDigitNotNull(),
        ];
    }
}
