<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    public $id;
    public $name;
    public $adress;
    public $familyMembers;

    /**
     * Get the family members for the family.
     */
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }

    /**
     * Get the total amount of contributions from all family members.
     */
    public function getTotalContributions()
    {
        $total = 0;
    
        $familyMembers = $this->familyMembers()->get();
        foreach($familyMembers as $member)
        {
            $total += $member->contributions->sum('amount');
        }
    
        return $total;
    }
}
