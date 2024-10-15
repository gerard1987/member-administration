<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\MemberType; 
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyMemberFactory extends Factory
{
    protected $model = FamilyMember::class;
    protected static $enumValues = ['Father', 'Mother', 'Son', 'Daughter'];

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'date_of_birth' => $this->faker->date,
            'member_type_id' => rand(1, 4),
            'family_id' => Family::factory(),
            'family_type' => $this->faker->randomElement(self::$enumValues)
        ];
    }
}
