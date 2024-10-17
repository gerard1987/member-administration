<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use DateTime;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date_of_birth', 'family_role', 'family_id'];
    protected static $roles = ['Father', 'Mother', 'Son', 'Daughter'];

    public $id;
    public $familyId;

    public $name;
    public $dateOfBirth;
    public $familyRole;


    /**
     * Get the family that familyMember belongs to.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function getAge()
    {
        $birthdateDateTime = new DateTime($this->date_of_birth);
        $currentDate = new DateTime();
    
        // Calculate the age by finding the difference in years
        $age = $currentDate->diff($birthdateDateTime)->y;
    
        return $age;
    }

    public static function getRoles()
    {
        return self::$roles;
    }

    /**
     * Get all contributions for this family member.
     */
    public function contributions()
    {
        return $this->hasMany(Contribution::class, 'family_member_id');
    }

     /**
     * Get the total contribution for this family member.
     */
    public function getTotalContribution()
    {
        return $this->contributions()->sum('amount');
    }
}
