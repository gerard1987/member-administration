<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;

    public int $id;
    public int $familyId;

    public string $name;
    public string $dateOfBirth;
    public string $memberType;


    /**
     * Get the family that familyMember belongs to.
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
