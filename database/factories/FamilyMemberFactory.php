<?php

namespace Database\Factories;

use App\Models\Family;
use App\Models\FamilyMember;
use App\Models\MemberType; 
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyMemberFactory extends Factory
{
    protected $model = FamilyMember::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName, // Generate a random first name
            'date_of_birth' => $this->faker->date, // Generate a random date of birth
            'member_type_id' => rand(1, 4),
            'family_id' => Family::factory(), // This will be set in the seeder
        ];
    }
}
