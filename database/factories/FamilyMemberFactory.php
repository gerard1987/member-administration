<?php 

namespace Database\Factories;

use App\Models\FamilyMember;
use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyMemberFactory extends Factory
{
    protected $model = FamilyMember::class;

    public function definition()
    {
        return [
            'name' => $this->faker->firstName,
            'date_of_birth' => $this->faker->date(),
            'family_id' => Family::factory(),
            'family_role' => $this->faker->randomElement(FamilyMember::getRoles())
        ];
    }   
}
