<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DateTime;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date_of_birth', 'family_type', 'family_id', 'member_type_id'];

    public $id;
    public $familyId;

    public $name;
    public $dateOfBirth;
    public $familyType;
    public $memberTypeId;


    /**
     * Get the family that familyMember belongs to.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * Get the member type that this family member belongs to.
     */
    public function memberType()
    {
        return $this->belongsTo(MemberType::class);
    }

    public function getAge()
    {
        $birthdateDateTime = new DateTime($this->date_of_birth);
        $currentDate = new DateTime();
    
        // Calculate the age by finding the difference in years
        $age = $currentDate->diff($birthdateDateTime)->y;
    
        return $age;
    }
}
