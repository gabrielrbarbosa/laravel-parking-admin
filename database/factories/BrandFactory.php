<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->randomElement(['Audi', 'BMW', 'Chevrolet', 'Fiat', 'Ford', 'Honda', 'Hyundai', 'Mercedes', 'Nissan', 'Toyota', 'Volkswagen']),
        ];
    }
}
