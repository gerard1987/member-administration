<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberType extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // Add other fields as needed

    // Define the relationship back to FamilyMember if needed
    public function familyMembers()
    {
        return $this->hasMany(FamilyMember::class);
    }
}
