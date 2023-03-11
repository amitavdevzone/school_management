<?php

namespace Database\Factories;

use App\Enums\RelationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guardian>
 */
class GuardianFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'contact_number' => $this->faker->phoneNumber(),
            'relation_type' => $this->faker->randomElement(RelationType::getValues()),
        ];
    }
}
