<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'license_plate' => $this->faker->regexify('[A-Z]{3}[0-9]{1}[A-Z]{1}[0-9]{2}'),
            'vehicle_type' => 'car',
            'size_type' => $this->faker->randomElement(['hatchback', 'sedan', 'suv', 'pickup', 'van', 'motorcycle', 'truck']),
            'fuel_type' => $this->faker->randomElement(['gasoline', 'ethanol', 'diesel', 'electric', 'hybrid']),
            'transmission_type' => $this->faker->randomElement(['manual', 'automatic']),
            //'brand_id' => Brand::factory()->create()->id,
            'brand_id' => Brand::inrandomorder()->first()->id,
            'model' => $this->faker->word,
            'year' => $this->faker->year,
            'color' => $this->faker->colorName,
            'image' => $this->faker->imageUrl()
        ];
    }
}
