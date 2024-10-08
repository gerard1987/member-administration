<?php

namespace Database\Factories;

use App\Models\MemberType;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberTypeFactory extends Factory
{
    protected $model = MemberType::class;

    public function definition(): array
    {
        return [
            'type' => $this->faker->randomElement(['member', 'prospective_member', 'honorary_member', 'family_member']),
        ];
    }
}
