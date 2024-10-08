<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    public $id;
    public $familyId;

    public $name;
    public $dateOfBirth;
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
}
