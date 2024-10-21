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


    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    /**
     * Returns the age determined by the members date of birth
     * 
     */
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
