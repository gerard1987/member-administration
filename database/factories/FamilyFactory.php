<?php

namespace Database\Factories;

use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyFactory extends Factory
{
    protected $model = Family::class;

    public function definition()
    {
        return [
            'name' => $this->faker->lastName, // Generate a random last name for the family
            'adress' => $this->faker->address, // Generate a random address
        ];
    }
}
