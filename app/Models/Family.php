<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    public int $id;
    public string $name;
    public string $adress;
    public string $familyMembers;

    /**
     * Get the family members for the family.
     */
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }
}
