<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MemberType;

class Contribution extends Model
{
    use HasFactory;

    protected $fillable = ['age', 'member_type_id', 'amount', 'fiscal_year', 'family_member_id'];

    public int $id;
    public int $age;
    public int $memberTypeId;
    public float $amount;
    public int $fiscalYear;
    public int $familyMemberId;

    private const BASEAMOUNT = 100;

    public static function calculateContributionForMember(int $age, string $memberType)
    {
        $discount = match(true) 
        {
            $memberType === "youth" && $age < 8 => 50,                   // 50% discount for youth under 8
            $memberType === "aspirant" && $age >= 8 && $age <= 12 => 40, // 40% discount for aspirants (8-12)
            $memberType === "junior" && $age >= 13 && $age <= 17 => 25,  // 25% discount for juniors (13-17)
            $memberType === "senior" && $age >= 18 && $age <= 50 => 0,   // 0% discount for seniors (18-50)
            $memberType === "elder" && $age >= 51 => 45,                 // 45% discount for elders 51+
            default => throw new \InvalidArgumentException("Invalid member type for age"),
        };
        
        return self::applyDiscount($discount);
    }

    private static function applyDiscount($percentage)
    {
        if ($percentage < 1){
            return (int)(self::BASEAMOUNT);
        }

        return (int)(self::BASEAMOUNT / 100 * $percentage);
    }

}
