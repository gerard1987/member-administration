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

        // Determine the member type based on the age
        $memberTypeId = $this->getMemberTypeByAge($age);
        $familyType = $this->getFamilyTypeByAge($age);

        return [
            'name' => $this->faker->firstName,
            'date_of_birth' => $dateOfBirth,
            'member_type_id' => $memberTypeId,
            'family_id' => Family::factory(),
            'family_type' => $familyType
        ];
    }

    private function getMemberTypeByAge($age)
    {
        if ($age < 8) {
            return 1; // Youth
        } elseif ($age >= 8 && $age <= 12) {
            return 2; // Aspirant
        } elseif ($age >= 13 && $age <= 17) {
            return 3; // Junior
        } elseif ($age >= 18 && $age <= 50) {
            return 4; // Senior
        } else {
            return 5; // Elder
        }
    }

    private function getFamilyTypeByAge($age)
    {
        if ($age <= 21){
            return rand(0, 1) ? 'Son' : 'Daughter';
        }
        else {
            return rand(0, 1) ? 'Father' : 'Mother';
        }
    }    
}
