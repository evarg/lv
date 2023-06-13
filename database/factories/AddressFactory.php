<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'number' => fake()->streetAddress(),
            'zip_code' => fake()->postcode(),
            'notes' => fake()->paragraph(1),
            'type' => 0,
        ];
    }
}
