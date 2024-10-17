<?php 

namespace Database\Factories;

use App\Models\FamilyMember;
use App\Models\Family;
use Illuminate\Database\Eloquent\Factories\Factory;

class FamilyMemberFactory extends Factory
{
    protected $model = FamilyMember::class;
    protected static $enumValues = ['Father', 'Mother', 'Son', 'Daughter'];

    public function definition()
    {
        // Generate a random date of birth within a reasonable range
        $dateOfBirth = $this->faker->date();

        // Create a FamilyMember instance to calculate age
        $member = new FamilyMember(['date_of_birth' => $dateOfBirth]);
        $age = $member->getAge();

        $familyRole = $this->getFamilyRoleByAge($age);

        return [
            'name' => $this->faker->firstName,
            'date_of_birth' => $dateOfBirth,
            'family_id' => Family::factory(),
            'family_role' => $familyRole
        ];
    }

    private function getFamilyRoleByAge($age)
    {
        if ($age <= 21){
            return rand(0, 1) ? 'Son' : 'Daughter';
        }
        else {
            return rand(0, 1) ? 'Father' : 'Mother';
        }
    }    
}
